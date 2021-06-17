<?php

namespace App\Models\Entity;

use App\Functions\format;
use App\Models\SystemInfo\SystemInfo;

abstract class Entity
{
    use format;
    use SystemInfo;

    protected $name;
    protected $email;
    protected $cpfCnpj;
    protected $cellPhone;
    protected $address;
    protected $registerDate;

    /***
     * Entity constructor.
     * @param String $name
     * @param String $cpfCnpj
     * @param String $cellPhone
     * @param Adress $address
     * @param $registerDate
     */
    public function __construct(string $name, string $email, string $cpfCnpj, string $cellPhone, Adress $address, $registerDate)
    {
        $this->name = $name;
        $this->email = $email;
        $this->cpfCnpj = $cpfCnpj;
        $this->cellPhone = $cellPhone;
        $this->address = $address;
        $this->registerDate = $registerDate;
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
