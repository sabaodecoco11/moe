<?php


interface ValidacaoCursoStrategy
{
    public function satisfacaoConclusao(float $porcentagemConclusao): bool;
}