<?php namespace App\Controllers;

use App\Models\CursoModel;
use App\Models\EmpregadorModel;
use App\Models\EmpresaModel;
use App\Models\EstagiarioModel;
use App\Models\UserModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Model;


class Users extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);


        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Email ou senha incorretos.'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();

                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();


                $getUsuarioEspecifico = function ($user) {
                    if ($user['tipoConta'] == 'EMPREGADOR') {
                        $empregador = new EmpregadorModel();
                        return $empregador->where('usuario_fk', $user['id'])->first();
                    } else if ($user['tipoConta'] == 'ESTAGIARIO') {
                        $estagiario = new EstagiarioModel();
                        return $estagiario->where('usuario_fk', $user['id'])->first();
                    } else return null;
                };


                $this->setUserSession($user, $getUsuarioEspecifico($user));
//                $session->setFlashdata('success', 'Successful Registration');
                return redirect()->to('dashboard');
            }
        }

        echo view('templates/header', $data);
        echo view('login');
        echo view('templates/footer');
    }

    private function setUserSession($user, $usuarioEspecifico)
    {
        $data = [
            'tipoConta' => $user['tipoConta'],
            'usuarioGeralId' => $user['id'],
            'usuarioEspecifico' => $usuarioEspecifico,
            'empresaId' => $usuarioEspecifico['empresa_fk'] ?? null,
            'email' => $user['email'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    protected function insereUsuario()
    {
        $userModel = new UserModel();
        $userData = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'tipoConta' => $this->request->getVar('tipoConta')
        ];
        $userModel->save($userData);

        return $userModel;
    }

    private function insereEmpregador()
    {
        $empresaData = [
            'nome' => $this->request->getVar('nome_empresa'),
            'endereco' => $this->request->getVar('endereco_empresa'),
            'descricao' => $this->request->getVar('descricao_empresa'),
            'produtos' => $this->request->getVar('descricao_produtos'),
        ];

        $empresa = new EmpresaModel();

        $empresaAdded = $empresa->existsByName($empresaData['nome']);

        //empresa não existe... logo crie uma
        if ($empresaAdded < 0) {
            $empresa->save($empresaData);
            $empresaAdded = $empresa->getInsertID();
            session()->set(['empresaId' => $empresaAdded]);
        }

        $usuario = $this->insereUsuario();

        $nomeContato = $this->request->getVar('nome_contato');
        $empregador = new EmpregadorModel();
        $empregadorData = [
            'nome' => $nomeContato,
            'empresa_fk' => $empresaAdded,
            'usuario_fk' => $usuario->getInsertID()
        ];

        $empregador->save($empregadorData);
    }

    private function insereEstagiario()
    {

        try {
            $usuario = $this->insereUsuario();

            $estagiarioData = [
                'nome' => $this->request->getVar('nome_estagiario'),
                'ano_ingresso' => $this->request->getVar('ano_ingresso'),
                'minicurriculo' => $this->request->getVar('minicurriculo'),
                'usuario_fk' => $usuario->getInsertID(),
                'curso_fk' => $this->request->getVar('curso')
            ];

            $estagiario = new EstagiarioModel();
            return $estagiario->save($estagiarioData);
        } catch(DatabaseException $db){

        }
        return null;
    }

    public
    function register()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //let's do the validation here
            $rules = [
                'email' => [
                    'rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[usuario.email]',
                    'errors' => [
                        'required' => 'Por gentileza, informe um e-mail!',
                        'is_unique' => 'Informe um e-mail único!',
                        'min_length' => 'O tamanho mínimo de um e-mail é de 6 caracteres!',
                        'valid_email' => 'O email fornecido é inválido!'
                    ]
                ],
                'password' => [
                    'rules' => 'required|max_length[255]|min_length[6]|regex_match[/^(?=.*\d)(?=.*[A-Z])(?=.*[$*&@#!?])[0-9a-zA-Z$*&@#!?]{6,}$/]',
                    'errors' => [
                        'required' => 'Insira uma senha!',
                        'regex_match' => 'A senha deve conter pelo menos: Caractere especial, letra maiúscula e número!',
                        'min_length' => 'A senha deve ter pelo menos 6 caracteres!'
                    ]
                ],
                'password_confirm' => [
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => 'A senha de confirmação não coincide!'
                    ]
                ],
                'tipoConta' => ['rules' => 'required']
            ];


            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                $tipoConta = $this->request->getVar('tipoConta');

                if ($tipoConta == 'EMPREGADOR') {
                    $this->insereEmpregador();
                } else if ($tipoConta == 'ESTAGIARIO') {
                    $this->insereEstagiario();
                }

                $session = session();
                $session->setFlashdata('success', 'Email foi enviado para conta!');
                return redirect()->to('/');

            }
        } //metodo get
        else {
            $cursoModel = new CursoModel();

            // Carregando os cursos
            $data['cursos'] = $cursoModel->findAll();
        }

        echo view('templates/header', $data);
        echo view('register');
        echo view('templates/footer');
    }

    public
    function profile()
    {

        $data = [];
        helper(['form']);
        $userModel = new UserModel();

        $empregadorModel = new EmpregadorModel();
        $estagiarioModel = new EmpregadorModel();

        $tipoConta = session()->get('tipoConta');

        if ($this->request->getMethod() == 'post') {
            //let's do the validation here
            $rules = [
                'nome' => [
                    'rules' => 'required|min_length[1]',
                    'errors' => [
                        'required' => 'Informe um nome!',
                        'min_length' => 'O nome deve conter pelo menos 1 caractere!'
                    ]
                ],
            ];

            if ($this->request->getPost('password') != '') {
                $rules['password'] = [
                    'rules' => 'required|max_length[255]|min_length[6]|regex_match[/^(?=.*\d)(?=.*[A-Z])(?=.*[$*&@#!?])[0-9a-zA-Z$*&@#!?]{6,}$/]',
                    'errors' => [
                        'required' => 'Insira uma senha!',
                        'regex_match' => 'A senha deve conter pelo menos: Caractere especial, letra maiúscula e número!',
                        'min_length' => 'A senha deve ter pelo menos 6 caracteres!'
                    ]
                ];
                $rules['password_confirm'] = [
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => 'A senha de confirmação não coincide!'
                    ]
                ];
            }

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {

                try {
                    $nomeEspecificoUsuario = $this->request->getPost('nome');

                    $usuarioEspecifico = session()->get('usuarioEspecifico');
                    $usuarioEspecifico['nome'] = $nomeEspecificoUsuario;
                    session()->set('usuarioEspecifico', $usuarioEspecifico);

                    if ($tipoConta == 'EMPREGADOR') {
                        $empregadorData = [
                            'id' => session()->get('usuarioEspecifico')['id'],
                            'nome' => $nomeEspecificoUsuario
                        ];
                        $empregadorModel->save($empregadorData);
                    } else {
                        $estagiarioData = [
                            'id' => session()->get('usuarioEspecifico')['id'],
                            'nome' => $nomeEspecificoUsuario
                        ];
                        $estagiarioModel->save($estagiarioData);
                    }

                    //muda a senha
                    if ($this->request->getPost('password') != '') {
                        $userPayloadData = [
                            'id' => session()->get('usuarioGeralId'),
                        ];

                        if ($this->request->getPost('password') != '') {
                            $userPayloadData['password'] = $this->request->getPost('password');
                        }

                        $userModel->save($userPayloadData);
                    }

                    session()->setFlashdata('success', 'Dados atualizados!');
                    return redirect()->to('/profile');
                } catch (DatabaseException $e) {
                    session()->setFlashdata('error', 'Erro!');
                    return redirect()->to('/profile');
                }


            }
        } else {
            if ($tipoConta == 'EMPREGADOR') {
                $data['user'] = $empregadorModel->where('usuario_fk', session()->get('usuarioGeralId'))->first();
            } else if ($tipoConta == 'ESTAGIARIO') {
                $data['user'] = $estagiarioModel->where('id', session()->get('usuarioGeralId'))->first();
            }
        }


        echo view('templates/header', $data);
        echo view('profile');
        echo view('templates/footer');
    }

    public
    function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

//--------------------------------------------------------------------
}
