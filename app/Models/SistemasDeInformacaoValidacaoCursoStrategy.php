<?php


class SistemasDeInformacaoValidacaoCursoStrategy implements ValidacaoCursoStrategy
{

    public function satisfacaoConclusao(float $porcentagemConclusao): bool
    {
        return ($porcentagemConclusao) && ($porcentagemConclusao >= 20.0 && $porcentagemConclusao <= 80.0);
    }
}