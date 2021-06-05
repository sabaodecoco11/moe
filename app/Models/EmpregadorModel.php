<?php


namespace App\Models;


use CodeIgniter\Model;
use SplObserver;

class EmpregadorModel extends Model implements \SplSubject
{
    protected $table = 'empregador';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'empresa_fk', 'usuario_fk'];

    public function attach(SplObserver $observer)
    {

    }

    public function detach(SplObserver $observer)
    {
        // TODO: Implement detach() method.
    }

    public function notify()
    {
        // TODO: Implement notify() method.
    }
}