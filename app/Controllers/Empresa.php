<?php namespace App\Controllers;

use App\Models\CursoModel;
use App\Models\EmpresaModel;
use App\Models\EstagiarioModel;
use App\Models\InteresseEmpresaModel;

class Empresa extends BaseController
{
	
    public function interesse()
    {
        $interesse = new InteresseEmpresaModel();

        $session = session();

        $cursoModel = new CursoModel();

        $estagiarioModel = new EstagiarioModel();

        $curso = $cursoModel->getCursoByEstagiarioId(session()->get('usuarioGeralId'));

        $porcentagemConclusaoEstagiario = $estagiarioModel->where('id', $session->get('usuarioEspecifico')['id'])->first()['porcentagem_conclusao'];

        $data = [
            'empresa_fk' => $this->request->getPost('empresa'),
            'estagiario_fk' => $session->get('usuarioEspecifico')['id'],
        ];

        try {
            $interesse->registrarInteresseEstagiario($curso->nome, $data, $porcentagemConclusaoEstagiario);
        } catch (\Exception $e){
            // TODO: mostra erro na view
            print_r($e->getMessage());
        }
        
        $session->setFlashdata('success', 'Você marcou interesse nesta empresa!');

        return redirect()->to('/');

    }
}
