<?php

namespace App\Models\Order;

use App\Functions\Collection;
use App\Models\Entity\Customer;
use App\Models\Entity\Store;
use App\Models\Entity\ShippingCompany;
use App\Models\payment\Payment;
use App\Models\Produto\Product;

class Order
{
    private $merchantOrderId;
    private $store;
    private $customer;
    private $shippingCompany;
    private $product;

    /***
     * Order constructor.
     * @param $merchantOrderId
     * @param Store $store
     * @param Customer $customer
     * @param ShippingCompany $shippingCompany
     * @param Collection $product
     */
    public function __construct($merchantOrderId, Store $store, Customer $customer, ShippingCompany $shippingCompany, Collection $product)
    {
        $this->merchantOrderId = $merchantOrderId;
        $this->store = $store;
        $this->customer = $customer;
        $this->shippingCompany = $shippingCompany;
        $this->product = $product;
        $this->customer = $customer;
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
