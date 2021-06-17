<?php


namespace App\Models\Payment;


class DebitCard extends Card implements PaymentMethod
{
    /**
     * CreditCard constructor.
     */
    public function __construct($cardNumber, $holder, $expirationDate, $securityCode, $brand)
    {
        parent::__construct($cardNumber, $holder, $expirationDate, $securityCode, $brand);
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
