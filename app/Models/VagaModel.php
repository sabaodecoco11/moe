<?php


namespace App\Models;


use CodeIgniter\Model;

class VagaModel extends Model
{
    protected $table = 'vaga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['descricao', 'semestre', 'atividades',
        'habilidades', 'carga_horaria', 'remuneracao', 'empresa_fk'
    ];

    public function getVagasByEmpresaId($empresaID)
    {
        return $this->where('empresa_fk', $empresaID)->get()->getResult();
    }

}