<?php

namespace App\Models\Payment;

interface PaymentMethod
{
    /***
     * @return bool
     */
    public function enable();

    /***
     * @return bool
     */
    public function disable();
}
