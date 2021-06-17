<?php

namespace App\Models\Entity;


class Store extends LegalEntity
{
    /***
     * Store constructor.
     * @param $name
     * @param $cpfCnpj
     * @param $cellPhone
     * @param $address
     * @param $cnae
     * @param $registerDate
     * @param $cnae
     */
    public function __construct($name, $email, $cpfCnpj, $cellPhone, $address, $cnae, $registerDate)
    {
        parent::__construct($name, $email, $cpfCnpj, $cellPhone, $address, $cnae, $registerDate);
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
