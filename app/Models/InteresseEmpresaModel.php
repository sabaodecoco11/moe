<?php


namespace App\Models;


use CodeIgniter\Model;
use GenericoValidacaoCursoStrategy;

class InteresseEmpresaModel extends Model
{
    protected $table = 'interesse_empresa';

    protected $primaryKey = 'id';

    protected $allowedFields = ['empresa_fk', 'estagiario_fk'];

    public function getNomeEstagiariosInteressadosByEmpresaId($empresaId)
    {
        $sqlQuery = "select nome, empresa_fk as empresa_id from estagiario est join interesse_empresa ie on est.id = ie.estagiario_fk where ie.empresa_fk = ${empresaId} group by empresa_fk, nome;";
        return $this->db->query($sqlQuery);
    }

    public function registrarInteresseEstagiario($nomeCurso, $data, $porcentagemConclusao)
    {
        $strategy = new \GenericoValidacaoCursoStrategy();

        switch ($nomeCurso) {
            case "Engenharia da Computação":
                $strategy = new \EngenhariaComputacaoValidacaoCursoStrategy();
                break;
            case "Sistemas de Informação":
                $strategy = new \SistemasDeInformacaoValidacaoCursoStrategy();
                break;
            case "Engenharia de Software":
                $strategy = new \EngenhariadeSoftwareValidacaoCursoStrategy();
                break;
        }

        $validacaoCursoContext = new \ValidacaoCursoContext($strategy);

        if (!$validacaoCursoContext->podeProsseguir($porcentagemConclusao)) {
            throw new \ErrorException('Porcentagem de conclusão rejeitada.');
        }

        $this->save($data);
    }


}