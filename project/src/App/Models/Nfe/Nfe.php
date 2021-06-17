<?php

namespace App\Models\Nfe;

use App\Functions\Collection;
use App\Models\Entity\Customer;
use App\Models\Entity\Store;
use App\Models\Entity\ShippingCompany;
use App\Models\Produto\Product;

class Nfe
{
    private $nfeType;
    private $operation;
    private $emitter;
    private $receiver;
    private $emitterDate;
    private $inOutDate;
    private $inOutTime;
    private $shippingCompany;
    private $product;

    /***
     * Nfe constructor.
     * @param int $nfeType
     * @param String $operation
     * @param Store $emitter
     * @param Customer $receiver
     * @param String $emitterDate
     * @param String $inOutDate
     * @param String $inOutTime
     * @param ShippingCompany $shippingCompany
     * @param array $product
     */

    public function __construct(int $nfeType, String $operation, Store $emitter, Customer $receiver, String $emitterDate, String $inOutDate,
                                String $inOutTime, ShippingCompany $shippingCompany, Collection $product)
    {
        $this->nfeType = $nfeType;
        $this->operation = $operation;
        $this->emitter = $emitter;
        $this->receiver = $receiver;
        $this->emitterDate = $emitterDate;
        $this->inOutDate = $inOutDate;
        $this->inOutTime = $inOutTime;
        $this->shippingCompany = $shippingCompany;
        $this->product = $product;
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
