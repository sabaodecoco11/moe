<?php namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\InteresseEmpresaModel;

class Empresa extends BaseController
{
	
    public function interesse()
    {

        $interesse = new InteresseEmpresaModel();

        $session = session();


        $data = [
            'empresa_fk' => $this->request->getPost('empresa'),
            'estagiario_fk' => $session->get('usuarioEspecifico')['id'],
        ];

        $interesse->save($data);
        
        $session->setFlashdata('success', 'Você marcou interesse nesta empresa!');


        return redirect()->to('/');

    }
}
