<?php


namespace App\Models\Payment;


class Card
{
    protected $cardNumber;
    protected $holder;
    protected $expirationDate;
    protected $securityCode;
    protected $brand;

    /**
     * Card constructor.
     * @param $cardNumber
     * @param $holder
     * @param $expirationDate
     * @param $securityCode
     * @param $brand
     */
    public function __construct($cardNumber, $holder, $expirationDate, $securityCode, $brand)
    {
        $this->cardNumber = $cardNumber;
        $this->holder = $holder;
        $this->expirationDate = $expirationDate;
        $this->securityCode = $securityCode;
        $this->brand = $brand;
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
