<?php


class EngenhariaComputacaoValidacaoCursoStrategy implements ValidacaoCursoStrategy
{

    public function satisfacaoConclusao(float $porcentagemConclusao): bool
    {
        return ($porcentagemConclusao) && ($porcentagemConclusao >= 40.0 && $porcentagemConclusao <= 80.0);
    }
}