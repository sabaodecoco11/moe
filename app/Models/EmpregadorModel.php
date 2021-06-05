<?php


namespace App\Models;


use CodeIgniter\Model;
use SplObserver;

class EmpregadorModel extends Model
{
    protected $table = 'empregador';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'empresa_fk', 'usuario_fk'];

}