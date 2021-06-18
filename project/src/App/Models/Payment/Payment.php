<?php

namespace App\Models\Payment;

use App\Functions\HttpStatusCodes;
use App\Http\Http;
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
        $paymentReturn = Http::requestGuzzle('POST', $paymentGateway->getApiUrl(),
            $paymentGateway->creditTransactionHeader(), $paymentGateway->creditTransactionBody($reference,
                $customer, $amount, $creditCard, $installments, $typePayment));

        return $this->response($paymentGateway, $paymentReturn);
    }

    /***
     * @param PaymentGateway $paymentGateway
     * @param $paymentId
     * @return string
     */
    public function getTransaction(PaymentGateway $paymentGateway, $paymentId)
    {
        $paymentReturn = Http::requestGuzzle('GET', $paymentGateway->getApiQueryUrl() . $paymentId,
            $paymentGateway->creditTransactionHeader());

        return $this->response($paymentGateway, $paymentReturn);
    }

    /***
     * @param $urlMetohd
     * @param PaymentGateway $paymentGateway
     * @param $paymentId
     * @return string
     */
    public function reverseTransaction($urlMetohd, PaymentGateway $paymentGateway, $paymentId)
    {
        return Http::requestGuzzle($urlMetohd,
            $paymentGateway->getApiUrl() . $paymentId . $paymentGateway->getApiQueryUrlComplement(),
            $paymentGateway->creditTransactionHeader());
    }

    /***
     * @param $paymentGateway
     * @param $response
     * @return mixed
     */
    public function response($paymentGateway, $response)
    {

        if (($response->getCode() == HttpStatusCodes::HTTP_BAD_REQUEST) ||
            ($response->getCode() == HttpStatusCodes::HTTP_NOT_FOUND)) {
            return $paymentGateway->responseFail($response);
        }

        if (($response->getStatusCode() == HttpStatusCodes::HTTP_CREATED) ||
            ($response->getStatusCode() == HttpStatusCodes::HTTP_OK)) {
            return $paymentGateway->formatResponseSuccess($response);
        }

    }

}
