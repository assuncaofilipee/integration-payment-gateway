<?php

namespace App\Models\Entity;

class Adress
{
    private $street;
    private $zipCode;
    private $UF;
    private $city;

    /**
     * Address constructor.
     * @param $street
     * @param $zipCode
     * @param $uf
     * @param $city
     */
    public function __construct(String $street, String $zipCode, String $UF, String $city)
    {
        $this->street = $street;
        $this->zipCode = $zipCode;
        $this->UF = $UF;
        $this->city = $city;
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
