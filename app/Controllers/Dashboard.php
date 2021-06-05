<?php namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\InteresseEmpresaModel;

class Dashboard extends BaseController
{
	public function index()
	{
		$data = [
        ];

		$empresaModel = new EmpresaModel();

		$isContaTipoEmpregador = session()->get('tipoConta') == 'EMPREGADOR';

		$empresas = $isContaTipoEmpregador ?
            $empresaModel->where('id', session()->get('empresaId'))->get()->getResult():
            $empresaModel->get()->getResult();
		$interesseEmpresaModel = new InteresseEmpresaModel();

		$interessadosImpresa = $isContaTipoEmpregador ? $interesseEmpresaModel->getNomeEstagiariosInteressadosByEmpresaId(session()->get('empresaId'))->getResult() : null;

		echo view('templates/header', $data);
		echo view('dashboard', [
		    'empresas' => $empresas,
            'interessados_vagas' => $interessadosImpresa
        ]);
		echo view('templates/footer');
	}

	//--------------------------------------------------------------------

}
