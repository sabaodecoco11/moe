<?php


namespace App\Models;


use CodeIgniter\Model;


class EstagiarioModel extends Model implements \SplObserver
{
    protected $table = 'estagiario';

    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'ano_ingresso', 'minicurriculo',
        'usuario_fk', 'curso_fk', 'porcentagem_conclusao'];
}