<?php


namespace App\Models;


use CodeIgniter\Model;


class InteresseEmpresaModel extends Model implements \SplObserver
{
    protected $table = 'interesse_empresa';

    protected $primaryKey = 'id';

    protected $allowedFields = ['empresa_fk', 'estagiario_fk'];


}