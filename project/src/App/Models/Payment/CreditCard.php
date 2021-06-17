<?php


namespace App\Models\Payment;

use App\Functions\format;

class CreditCard extends Card implements PaymentMethod
{
    use format;

    /***
     * CreditCard constructor.
     * @param $cardNumber
     * @param $holder
     * @param $expirationDate
     * @param $securityCode
     * @param $brand
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
