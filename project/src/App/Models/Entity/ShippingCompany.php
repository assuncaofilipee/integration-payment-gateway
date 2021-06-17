<?php

namespace App\Models\Entity;

class ShippingCompany extends LegalEntity
{
    private $shipping;
    private $weight;

    /***
     * ShippingCompany constructor.
     * @param float $shipping
     * @param float $weight
     */
    public function __construct($name, $email, $cpfCnpj, $cellPhone, $address, $cnae, $registerDate, float $shipping, float $weight)
    {
        parent::__construct($name, $cpfCnpj, $email, $cellPhone, $address, $cnae, $registerDate);
        $this->shipping = $shipping;
        $this->weight = $weight;
    }

    /**
     * @return LegalEntity
     */
    public function getCompany(): LegalEntity
    {
        return $this->company;
    }

    /**
     * @param LegalEntity $company
     */
    public function setCompany(LegalEntity $company)
    {
        $this->company = $company;
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

