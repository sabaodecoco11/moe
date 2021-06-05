<?php


namespace App\Models;


use CodeIgniter\Model;

class CursoModel extends Model
{
    protected $table = 'curso';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome'];
}