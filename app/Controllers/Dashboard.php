<?php namespace App\Controllers;

use App\Models\EmpresaModel;

class Dashboard extends BaseController
{
	public function index()
	{
		$data = [
        ];

		$data['algo'] = 'Meu grande nome!';


		$empresas = new EmpresaModel();

		$empresas = $empresas->get();

		echo view('templates/header', $data);
		echo view('dashboard', ['empresas' => $empresas->getResult()]);
		echo view('templates/footer');
	}

	//--------------------------------------------------------------------

}
