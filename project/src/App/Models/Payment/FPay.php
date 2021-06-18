<?php

namespace App\Models\Payment;

use App\Models\Entity\Customer;

class FPay implements PaymentGateway
{
    /***
     * @return string
     */
    public function getApiUrl(): string
    {
        return getenv("API_URL_FPAY_CREDITO");
    }

    /***
     * @return string
     */
    public function getApiQueryUrl(): string
    {
        return getenv("API_URL_FPAY_CREDITO");
    }

    /***
     * @return string
     */
    public function getApiQueryUrlComplement(): string
    {
        return getenv("API_QUERY_URL_FPAY_CREDITO_COMPLEMENT");
    }

    /***
     * @return array
     */
    public function creditTransactionHeader()
    {
        return ['Content-Type' => 'application/json',
            'Client-Code' => getenv("API_CLIENT_CODE_FPAY"),
            'Client-key' => getenv("API_CLIENT_KEY_FPAY")
        ];
    }

    /***
     * @param $reference
     * @param Customer $customer
     * @param $amount
     * @param CreditCard $creditCard
     * @param $installments
     * @return array
     */
    public function creditTransactionBody($reference, Customer $customer, $amount, CreditCard $creditCard, $installments, $typePayment)
    {
        return
            ['body' => json_encode(
                ["url_retorno" => getenv("API_URL_RETURN_FPAY"),
                    "nu_referencia" => $reference,
                    "nm_cliente" => $customer->name,
                    "nu_documento" => $customer->cpfCnpj,
                    "ds_email" => $customer->email,
                    "nu_telefone" => $customer->cellPhone,
                    "vl_total" => $amount,
                    "nu_parcelas" => $installments,
                    "tipo_venda" => $typePayment,
                    "nm_bandeira" => $creditCard->brand,
                    "nu_cartao" => $creditCard->cardNumber,
                    "nm_titular" => $creditCard->holder,
                    "dt_validade" => $creditCard->expirationDate
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            ];
    }

    /***
     * @param $response
     * @return string
     */
    public function formatResponseSuccess($response)
    {
        return
            json_encode(["success" => true,
                'status' => $response->getStatusCode(),
                'data' => json_decode($response->getBody()->getContents())->data
            ], JSON_UNESCAPED_SLASHES);
    }

    public function responseFail($response)
    {
        return json_encode($response->getResponse()->getBody()->getContents(),JSON_UNESCAPED_SLASHES);

    }

}
