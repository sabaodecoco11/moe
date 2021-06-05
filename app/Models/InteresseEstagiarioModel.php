<?php


namespace App\Models;


use CodeIgniter\Model;

class InteresseEstagiarioModel extends Model
{
    protected $table = 'interesse_estagiario';

    protected $primaryKey = 'id';

    protected $allowedFields = ['estagiario_fk', 'empresa_fk', 'vaga_fk'];
}