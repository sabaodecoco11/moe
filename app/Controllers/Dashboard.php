<?php namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\InteresseEmpresaModel;

class Dashboard extends BaseController
{
	public function index()
	{
		$data = [
        ];

		$empresas = new EmpresaModel();
		$interesseEmpresaModel = new InteresseEmpresaModel();

		$empresas = $empresas->get();

		echo view('templates/header', $data);
		echo view('dashboard', [
		    'empresas' => $empresas->getResult(),
            'interessados_vagas' => $interesseEmpresaModel->getNomeEstagiariosInteressadosImpresas()->getResult()
        ]);
		echo view('templates/footer');
	}

	//--------------------------------------------------------------------

}
