<?php


namespace App\Models\Payment;


class Card
{
    protected $cardNumber;
    protected $holder;
    protected $expirationDate;
    protected $securityCode;
    protected $brand;
    protected $active;

    /***
     * Card constructor.
     * @param string $cardNumber
     * @param string $holder
     * @param string $expirationDate
     * @param string $securityCode
     * @param string $brand
     * @param bool $active
     */
    public function __construct(string $cardNumber, string $holder, string $expirationDate, string $securityCode, string $brand, bool $active)
    {
        $this->cardNumber = $cardNumber;
        $this->holder = $holder;
        $this->expirationDate = $expirationDate;
        $this->securityCode = $securityCode;
        $this->brand = $brand;
        $this->active = $active;
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

    /***
     * @return bool
     */
    public function disable()
    {
        return $this->active = false;
    }

    /***
     * @return boll
     */
    public function enable()
    {
        return $this->active = true;
    }
}
