<?php


class Estagiario implements \SplObserver
{
    private $id;
    private $nome;
    private $ano_ingresso;
    private $minicurriculo;
    private $usuario;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getAnoIngresso()
    {
        return $this->ano_ingresso;
    }

    /**
     * @param mixed $ano_ingresso
     */
    public function setAnoIngresso($ano_ingresso): void
    {
        $this->ano_ingresso = $ano_ingresso;
    }

    /**
     * @return mixed
     */
    public function getMinicurriculo()
    {
        return $this->minicurriculo;
    }

    /**
     * @param mixed $minicurriculo
     */
    public function setMinicurriculo($minicurriculo): void
    {
        $this->minicurriculo = $minicurriculo;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }


    public function update(SplSubject $subject)
    {
        // TODO: Implement update() method.
    }
}
