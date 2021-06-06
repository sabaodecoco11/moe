<?php


namespace App\Models;


use CodeIgniter\Model;

class CursoModel extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome'];

    public function getCursoByEstagiarioId($estagiarioID){
        $sqlQuery = "select c.id, c.nome from estagiario est join curso c on est.curso_fk=c.id where est.usuario_fk = $estagiarioID";
        return $this->db->query($sqlQuery)->getFirstRow();
    }
}