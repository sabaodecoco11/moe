<?php


class ValidacaoCursoContext
{

    private $strategy;

    public function __construct(ValidacaoCursoStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(ValidacaoCursoStrategy $strategy){
        $this->strategy = $strategy;
    }

    public function podeProsseguir($porcentagemConclusao){
        return $this->strategy->satisfacaoConclusao($porcentagemConclusao);
    }

}