<?php


class Empresa implements \SplSubject
{
    private $id;
    private $nome;
    private $endereco;
    private $descricao;
    private $produtos;
    private $vagas = [];

    /**
     * Empresa constructor.
     * @param $id
     * @param $nome
     * @param $endereco
     * @param $descricao
     * @param $produtos
     */
    public function __construct($id, $nome, $endereco, $descricao, $produtos)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->descricao = $descricao;
        $this->produtos = $produtos;
    }


    public function attach(SplObserver $observer)
    {
        // TODO: Implement attach() method.
    }

    public function detach(SplObserver $observer)
    {
        // TODO: Implement detach() method.
    }

    public function notify()
    {
        // TODO: Implement notify() method.
    }

    /**
     * @return array
     */
    public function getVagas(): array
    {
        return $this->vagas;
    }

    /**
     * @param array $vagas
     */
    public function setVagas(array $vagas): void
    {
        $this->vagas = $vagas;
    }


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
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco): void
    {
        $this->endereco = $endereco;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getProdutos()
    {
        return $this->produtos;
    }

    /**
     * @param mixed $produtos
     */
    public function setProdutos($produtos): void
    {
        $this->produtos = $produtos;
    }


}