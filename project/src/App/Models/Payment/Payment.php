<?php

namespace App\Models\Payment;

use App\Functions\Http;
use App\Models\Entity\Customer;

class Payment
{
    /***
     * @param PaymentGateway $paymentGateway
     * @param $reference
     * @param Customer $customer
     * @param $amount
     * @param CreditCard $creditCard
     * @param $installments
     * @return string
     */
    public function payCreditCard(PaymentGateway $paymentGateway, $reference, Customer $customer, $amount,
                                  CreditCard $creditCard, $installments, $typePayment)
    {
        return Http::requestGuzzle('POST', $paymentGateway->getApiUrl(),
            $paymentGateway->creditTransactionHeader(), $paymentGateway->creditTransactionBody($reference,
                $customer, $amount, $creditCard, $installments, $typePayment)
        );
    }

    /***
     * @param PaymentGateway $paymentGateway
     * @param $paymentId
     * @return string
     */
    public function getTransaction(PaymentGateway $paymentGateway, $paymentId)
    {
        return Http::requestGuzzle('GET', $paymentGateway->getApiQueryUrl() . $paymentId,
            $paymentGateway->creditTransactionHeader());
    }

    /***
     * @param $urlMetohd
     * @param PaymentGateway $paymentGateway
     * @param $paymentId
     * @return string
     */
    public function reverseTransaction($urlMetohd, PaymentGateway $paymentGateway, $paymentId)
    {
        return Http::requestGuzzle(
            $urlMetohd,
            $paymentGateway->getApiUrl() . $paymentId . $paymentGateway->getApiQueryUrlComplement(),
            $paymentGateway->creditTransactionHeader());
    }
}
