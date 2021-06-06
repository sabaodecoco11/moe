<?php


class GenericoValidacaoCursoStrategy implements ValidacaoCursoStrategy
{

    public function satisfacaoConclusao(float $porcentagemConclusao): bool
    {
        return $porcentagemConclusao > 0.0 && $porcentagemConclusao < 100.0;
    }
}