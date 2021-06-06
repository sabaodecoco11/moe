<?php


namespace App\Controllers;


use App\Models\EstagiarioModel;
use App\Models\InteresseEmpresaModel;
use App\Models\VagaModel;
use App\Models\InteresseEstagiarioModel;
use App\Models\UserModel;


class Vagas extends BaseController
{
    public function index()
    {
        $data = [
        ];

        $data['algo'] = 'Meu grande nome!';

        if ($this->request->getMethod() == 'post') {

        }

        echo view('templates/header', $data);
        echo view('vaga-create');
        echo view('templates/footer');
    }

    public function editar($vagaId)
    {
        $data = [];
        helper(['form']);

        $vagaModel = new VagaModel();

        if ($this->request->getMethod() == 'post') {
            $vagaData = [
                'descricao' => $this->request->getPost('descricao'),
                'atividades' => $this->request->getPost('atividades'),
                'habilidades' => $this->request->getPost('habilidades'),
                'carga_horaria' => $this->request->getPost('cargaHoraria'),
                'semestre' => $this->request->getPost('semestre'),
                'remuneracao' => $this->request->getPost('remuneracao'),
            ];
            $vagaModel->update($vagaId, $vagaData);

            return redirect()->to('/consultar-vaga');
        } else {
            $data['vaga'] = $vagaModel->where('id', $vagaId)->first();
        }

        echo view('templates/header', $data);
        echo view('vaga-edit');
        echo view('templates/footer');


    }

    public function consultas()
    {
        $data = [];

        $vagasModel = new VagaModel();
        $interesseEmpresaModel = new InteresseEmpresaModel();

        $vagas = session()->get('tipoConta') == 'EMPREGADOR' ?
            $vagasModel->getVagasByEmpresaId(session()->get('empresaId'))
            : $vagasModel->get()->getResult();

        echo view('templates/header', $data);
        echo view('vaga-consulta', [
            'vagas' => $vagas,
        ]);
        echo view('templates/footer');
    }

    public
    function cadastrar()
    {
        $data = [];
        helper(['form']);


        if ($this->request->getMethod() == 'post') {
            //let's do the validation here
            $rules = [
                'descricao' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Por gentileza, informe a descrição da vaga'
                    ]
                ],
                'atividades' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Por gentileza, informe as atividades'
                    ]
                ],
                'habilidades' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Por gentileza, informe as habilidades'
                    ]
                ],
                'cargaHoraria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Por gentileza, informe a carga horária'
                    ]
                ],
                'semestre' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Por gentileza, informe o semestre'
                    ]
                ],
                'remuneracao' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Por gentileza, informe a remuneração'
                    ]
                ],
            ];


            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $vaga = new VagaModel();

                $empresa_fk = session()->get('empresaId');

                $vagaData = [
                    'descricao' => $this->request->getPost('descricao'),
                    'atividades' => $this->request->getPost('atividades'),
                    'habilidades' => $this->request->getPost('habilidades'),
                    'carga_horaria' => $this->request->getPost('cargaHoraria'),
                    'semestre' => $this->request->getPost('semestre'),
                    'remuneracao' => $this->request->getPost('remuneracao'),
                    'empresa_fk' => $empresa_fk
                ];

                $vaga->save($vagaData);

                // Send email to all users that has interest in this company.
                $interesseEmpresa = new InteresseEmpresaModel();
                $interesseEmpresa = $interesseEmpresa->where('empresa_fk', $empresa_fk)->get();

                foreach ($interesseEmpresa->getResult() as $row) {
                    $estagiario = new EstagiarioModel();
                    $estagiario = $estagiario->where('id', $row->estagiario_fk)->first();
                    $usuario = new UserModel();
                    $usuario = $usuario->where('id', $estagiario['usuario_fk'])->first();
                    $this->sendingEmail($usuario['email']);
                }


                $session = session();
                $session->setFlashdata('success', 'Vaga criada e estagiários notificados!');
            }
        }


        return redirect()->to('/consultar-vaga');
    }

    public function sendingEmail($email)
    {
        $to = $email;
        $subject = 'Uma nova vaga foi cadastrada!';
        $message = 'Uma empresa em que você ficou interessado abriu uma nova vaga!';

        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom('empresa@empresa.com', 'Nova vaga');

        $email->setSubject($subject);
        $email->setMessage($message);

        $email->send();
    }


}