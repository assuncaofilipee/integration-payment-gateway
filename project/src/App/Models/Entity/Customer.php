<?php

namespace App\Models\Entity;


use App\Functions\format;

class Customer extends PhysicalEntity
{
    use format;

    /***
     * Customer constructor.
     * @param $name
     * @param $email
     * @param $cpfCnpj
     * @param $cellPhone
     * @param $address
     * @param $registerDate
     * @param $birthDate
     */
    public function __construct($name, $email, $cpfCnpj, $cellPhone, $address, $registerDate, $birthDate)
    {
        parent::__construct($name, $email, $cpfCnpj, $cellPhone, $address, $registerDate, $birthDate);
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
