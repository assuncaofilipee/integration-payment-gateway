<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Functions\Collection;
use App\Models\Entity\Adress;
use App\Models\Entity\Customer;
use App\Models\Entity\Store;
use App\Models\Payment\Cielo;
use App\Models\Payment\CreditCard;
use App\Models\Entity\ShippingCompany;
use App\Models\Payment\FPay;
use App\Models\Payment\Payment;
use App\Models\Product\Product;
use App\Models\Order\Order;
use Faker\Factory;

    $faker = Factory::create('pt_BR');

    $adress = new Adress(
        $faker->streetName,
        $faker->postcode, 
        'SC', 
        $faker->city
    );

    $customer = new Customer(
        $faker->name, 
        $faker->email,
        $faker->cpf, 
        '48920006356',
        $adress, 
        $faker->date(),
        new \DateTime('2020-06-03')
    );

    $store = new Store(
        $faker->name,
        $faker->email, 
        $faker->cnpj, 
        '48920006589',
        $adress, 
        'software', 
        new \DateTime('2020-06-03')
    );

    $shippingCompany = new ShippingCompany(
        'FASTTRANSPORTES', 
        $faker->email, 
        $faker->cnpj, 
        '48920006589',
        $adress, 
        'software', 
        new \DateTime('2020-06-03'), 
        13.55, 
        300
    );

    $products = new Collection(
        new Product(
        5554, 
        'binquedo', 
        256, 
        25, 
        100, 
        2500
        )
    );

    $products->add(
        new Product(
            5554, 
            'brinquedo', 
            256, 
            25, 
            100, 
            2500
        )
    );

    $order = new Order(
        '135980',
        $store,
        $customer,
        $shippingCompany,
        $products
    );

    $payment = new Payment();
    $cielo = new Cielo();
    $fpay = new FPay();

    $creditCard = new CreditCard(
        '5159-2673-6337-7964', 
        'Teste', 
        '09/2028', 
        '122', 
        'master', 
        true
    );

    $paymentReturn = $payment->payCreditCard(
        $cielo, 
        $order->merchantOrderId,
        $customer, 
        50000, 
        $creditCard, 
        1
    );
    
echo "PAYMENT CIELO \n" . $paymentReturn . "\n\n";

$paymentId = json_decode($paymentReturn, true)["Payment"]["PaymentId"];

echo "GET PAYMENT CIELO \n" . $payment->getTransaction($cielo, $paymentId) . "\n\n";

echo "REVERSE PAYMENT CIELO \n" . $payment->reverseTransaction('PUT', $cielo, $paymentId) . "\n\n";

$creditCard = new CreditCard('5159267363377964', 'Teste', '11/28', '122', 'master', true);

$paymentReturn = $payment->payCreditCard($fpay, $order->merchantOrderId, $customer, 50.00, $creditCard, 1);

echo "PAYMENT FPAY \n" . $paymentReturn . "\n\n";

$paymentId = json_decode($paymentReturn, true)["data"]["fid"];

echo "GET PAYMENT FAPY \n" . $payment->getTransaction($fpay, $paymentId) . "\n\n";

echo "REVERSE PAYMENT FPAY \n" . $payment->reverseTransaction('DELETE', $fpay, $paymentId) . "\n\n";





