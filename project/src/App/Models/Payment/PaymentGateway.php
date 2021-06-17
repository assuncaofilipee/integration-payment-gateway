<?php

namespace App\Models\Payment;

use App\Models\Entity\Customer;

interface PaymentGateway
{
    /***
     * @param $reference
     * @param Customer $customer
     * @param $amount
     * @param CreditCard $creditCard
     * @param $installments
     * @return mixed
     */
    public function creditTransactionBody($reference, Customer $customer, $amount,
        CreditCard $creditCard, $installments, $typePayment);

    /***
     * @return mixed
     */
    public function creditTransactionHeader();

    /***
     * @return string
     */
    public function getApiQueryUrlComplement(): string;

    /***
     * @return string
     */
    public function getApiUrl(): string;

}
