<?php


namespace App\Models\Product;


class Product
{
    private $codigoProduto;
    private $descricaoProduto;
    private $ncm;
    private $quantidade;
    private $amountUnitario;
    private $amountTotal;

    /**
     * ProdutosServicos constructor.
     * @param $codigoProduto
     * @param $descricaoProduto
     * @param $ncm
     * @param $quantidade
     * @param $amountUnitario
     * @param $amountTotal
     */
    public function __construct($codigoProduto, $descricaoProduto, $ncm, $quantidade, float $amountUnitario, float $amountTotal)
    {
        $this->codigoProduto = $codigoProduto;
        $this->descricaoProduto = $descricaoProduto;
        $this->ncm = $ncm;
        $this->quantidade = $quantidade;
        $this->amountUnitario = $amountUnitario;
        $this->amountTotal = $amountTotal;
    }

    /***
     * @param $atrib
     * @return mixed
     */
    public function __get($atrib)
    {
        return $this->$atrib;
    }

    /***
     * @param $atrib
     * @param $value
     */
    public function __set($atrib, $value)
    {
        $this->$atrib = $value;
    }
}
