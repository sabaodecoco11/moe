<?php


namespace App\Models;


use CodeIgniter\Model;


class InteresseEmpresaModel extends Model implements \SplObserver
{
    protected $table = 'interesse_empresa';

    protected $primaryKey = 'id';

    protected $allowedFields = ['empresa_fk', 'estagiario_fk'];

    public function getNomeEstagiariosInteressadosImpresas(){
        return $this->db->query('select nome, empresa_fk as empresa_id from estagiario est join interesse_empresa ie on est.id = ie.estagiario_fk group by empresa_fk, nome;');
    }


}