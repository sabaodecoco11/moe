<?php


namespace App\Models;


use CodeIgniter\Model;
use SplObserver;

class EmpresaModel extends Model
{
    protected $table = 'empresa';

    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'endereco', 'descricao', 'produtos'];


    public function existsByName($nome)
    {
        $res_object = $this->db->query("select id from empresa where nome = \"{$nome}\" limit 1")->getResultObject();
        return sizeof($res_object) > 0 ? $res_object[0]->id : -1;
    }


}