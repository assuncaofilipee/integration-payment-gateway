<?php

namespace App\Models\Entity;

use App\Helpers\Helper;


abstract class PhysicalEntity extends Entity
{

    protected $birthDate;

    /**
     * PhysicalPerson constructor.
     * @param $name
     * @param $email
     * @param $cpfCnpj
     * @param $cellPhone
     * @param $address
     * @param $birthDate
     * @param $registerDate
     */

    public function __construct($name, $email, $cpfCnpj, $cellPhone, $address, $birthDate, $registerDate)
    {
        parent::__construct($name, $email, $cpfCnpj, $cellPhone, $address, $registerDate);
        $this->birthDate = $birthDate;
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
     * @return cpf
     */
    public function getCpfCnpj()
    {
        return Helper::mask("###.###.###-##", $this->cpfCnpj);
    }
}
