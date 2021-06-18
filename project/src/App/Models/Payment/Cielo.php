<?php

namespace App\Models\Payment;

use App\Models\Entity\Customer;

class Cielo implements PaymentGateway
{
    /***
     * @return string
     */
    public function getApiUrl(): string
    {
        return getenv("API_URL_CIELO");
    }

    /***
     * @return string
     */
    public function getApiQueryUrl(): string
    {
        return getenv("API_QUERY_URL_CLIELO");
    }

    /***
     * @return string
     */
    public function getApiQueryUrlComplement(): string
    {
        return getenv("API_QUERY_URL_CIELO_CREDITO_COMPLEMENT");
    }

    /***
     * @return array
     */
    public function creditTransactionHeader()
    {
        return
            ['Content-Type' => 'application/json',
                'MerchantId' => getenv("MERCHANT_ID_CLIELO"),
                'MerchantKey' => getenv("MERCHANT_KEY_CLIELO")];
    }

    /***
     * @param $reference
     * @param Customer $customer
     * @param $amount
     * @param CreditCard $creditCard
     * @param $installments
     * @return array
     */
    public function creditTransactionBody($reference, Customer $customer, $amount,
                                          CreditCard $creditCard, $installments, $typePayment)
    {
        return
            ['body' => json_encode(
                ['MerchantOrderId' => $reference,
                    "Customer" => [
                        "Name" => $customer->name
                    ],
                    "Payment" => [
                        "Type" => "CreditCard",
                        "Interest" => $typePayment,
                        "Amount" => $amount,
                        "Installments" => $installments,
                        "CreditCard" =>
                            $creditCard->toArray()
                        ,
                    ]
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            ];
    }

    /***
     * @param $response
     * @return string
     */
    public function formatResponseSuccess($response)
    {
        return json_encode(['success' => true,
            'status' => $response->getStatusCode(),
            'data' => json_decode($response->getBody()->getContents())
        ], JSON_UNESCAPED_SLASHES);
    }

    public function responseFail($response)
    {
        return json_encode(['success' => false,
            'status' => $response->getStatusCode(),
            'Message' => json_decode($response->getResponse()->getBody()->getContents())
        ], JSON_UNESCAPED_SLASHES);
    }

}
