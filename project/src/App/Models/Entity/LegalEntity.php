<?php

namespace App\Models\Entity;

use App\Helpers\Helper;


abstract class LegalEntity extends Entity
{

    protected $cnae;
    /**
     * LegalPerson constructor.
     * @param $name
     * @param $cpfCnpj
     * @param $cellPhone
     * @param $address
     * @param $cnae
     * @param $registerDate
     */
    public function __construct($name, $email, $cpfCnpj, $cellPhone, $address, $cnae, $registerDate)
    {
        parent::__construct($name, $email,$cpfCnpj, $cellPhone, $address, $registerDate);
        $this->cnae = $cnae;
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
    /**
     * @return cnpj
     */
    public function getCpfCnpj()
    {
        return Helper::mask("##.###.###/####-##",$this->cpfCnpj);
    }
}
