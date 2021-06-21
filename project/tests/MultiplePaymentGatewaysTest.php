<?php

namespace Tests;

use App\Models\Entity\Address;
use Faker\Factory;
use App\Functions\Collection;
use App\Models\Entity\Customer;
use App\Models\Entity\Store;
use App\Models\Payment\Cielo;
use App\Models\Payment\CreditCard;
use App\Models\Entity\ShippingCompany;
use App\Models\Payment\FPay;
use App\Models\Payment\Payment;
use App\Models\Product\Product;
use App\Models\Order\Order;
use PHPUnit\Framework\TestCase;

class MultiplePaymentGatewaysTest extends TestCase
{
    private $address;
    private $customer;
    private $store;
    private $shippingCompany;
    private $products;
    private $order;
    private $payment;
    private $cielo;
    private $fpay;
    private $creditCard;

    public function setUp(): void
    {
        parent::setUp();

        $faker = Factory::create('pt_BR');

        $this->address = new address($faker->streetName, $faker->postcode, 'SC', $faker->city);

        $this->customer = new Customer($faker->name, $faker->email, $faker->cpf, '48920006356',
            $this->address, $faker->date(), new \DateTime('2020-06-03'));

        $this->store = new Store($faker->name, $faker->email, $faker->cnpj, '48920006589',
            $this->address, 'software', new \DateTime('2020-06-03'));

        $this->shippingCompany = new ShippingCompany($faker->company, $faker->email, $faker->cnpj,
            '48920006589', $this->address, 'transport',
            new \DateTime('2020-06-03'), 13.55, 300);

        $this->products = new Collection(new Product(5554, 'brinquedo',
            256, 25, 100, 250.00));

        $this->products->add(new Product(5554, 'brinquedo', 256,
            25, 100, 2.500));

        $this->order = new Order('135980', $this->store, $this->customer,
            $this->shippingCompany, $this->products);

        $this->creditCard = new CreditCard('5159-2673-6337-7964', 'Teste',
            '09/2028', '122', 'master', true);

        $this->payment = new Payment();
        $this->cielo = new Cielo();
        $this->fpay = new FPay();
    }

    public function test_can_be_paid_credit_card_by_cielo(): void
    {
        $paymentReturn = json_decode($this->payment->payCreditCard($this->cielo, $this->order->merchantOrderId, $this->customer,
            50.000, $this->creditCard, 1, 'ByMerchant'));

        $this->assertEquals(201, $paymentReturn->status);
    }

   public function test_can_be_paid_credit_card_by_fpay(): void
   {
       $this->creditCard->__set("expirationDate", "09/28");

       $paymentReturn = json_decode($this->payment->payCreditCard($this->fpay, $this->order->merchantOrderId,
           $this->customer, 50.00, $this->creditCard, 1, 'AV'));

       $this->assertEquals(true, $paymentReturn->success);
   }

   public function test_can_be_get_payment_cielo()
   {
       $paymentReturn = json_decode($this->payment->payCreditCard($this->cielo, $this->order->merchantOrderId, $this->customer,
           50.000, $this->creditCard, 1, 'ByMerchant'))->data;

       $paymentGatted = json_decode($this->payment->getTransaction($this->cielo, $paymentReturn->Payment->PaymentId));

       $this->assertObjectHasAttribute("AuthorizationCode", $paymentGatted->data->Payment);
   }

   public function test_can_be_get_payment_fpay()
   {
       $this->creditCard->__set("expirationDate", "09/28");

       $paymentReturn = json_decode($this->payment->payCreditCard($this->fpay, $this->order->merchantOrderId,
           $this->customer, 50.00, $this->creditCard, 1, 'AV'));

       $paymentGatted = $this->payment->getTransaction($this->fpay, $paymentReturn->data->fid);

       $this->assertStringContainsString("nu_referencia", $paymentGatted);
   }

   public function test_can_be_reverse_payment_cielo()
   {
       $paymentReturn = json_decode($this->payment->payCreditCard($this->cielo, $this->order->merchantOrderId, $this->customer,
           50.000, $this->creditCard, 1, 'ByMerchant'))->data;

       $paymentReversed = $this->payment->reverseTransaction('PUT', $this->cielo, $paymentReturn->Payment->PaymentId);

       $this->assertEquals(200, $paymentReversed->getStatusCode());
   }

   public function test_can_be_reverse_payment_fpay()
   {
       $this->creditCard->__set("expirationDate", "09/28");

       $paymentReturn = json_decode($this->payment->payCreditCard($this->fpay, $this->order->merchantOrderId,
           $this->customer, 50.00, $this->creditCard, 1, 'AV'))->data;

       $paymentReversed =  $this->payment->reverseTransaction('DELETE', $this->fpay, $paymentReturn->fid);

       $this->assertEquals(200, $paymentReversed->getStatusCode());
   }

   public function test_failure_paid_credit_card_by_cielo()
   {
       $paymentReturn = $this->payment->payCreditCard($this->cielo, $this->order->merchantOrderId, $this->customer,
           50.000, $this->creditCard, 'ss', 'ByMerchant');

       $this->assertEquals(true, $paymentReturn->success);
   }
}
