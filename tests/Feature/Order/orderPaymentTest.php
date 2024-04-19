<?php

namespace Tests\Feature\Order;

use App\Models\Pos;
use Tests\TestCase;
use App\Models\OrderMaster;
use App\Models\PaymentMode;
use App\Models\PaymentType;
use App\Models\Service;
use App\Models\Waiter;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class orderPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexFunction(): void
    {
        $response = $this->get('/api/order/order-payment');
        $response->assertStatus(200);
    }
    public function testShowFunction(): void
    {
        $response = $this->get('/api/order/order-payment/1');
        $response->assertStatus(200);
    }

    public function testStoreFunction(): void
    {
        $pos =  Pos::create([
            "name" => "firstPOS",
            "name_loc" => "firstPOS",
            'phone' => '022503',
        ]);
        $serviceData = Service::create([

            "name" => "service1",
            "name_loc" => "service",

        ]);
        $waiterData = Waiter::create([
            "pos_id" => $pos->id,
            "name" => "waiter",
            "name_loc" => "waiter",

        ]);
        $orderMaster = OrderMaster::create([
            'pos_id' => $pos->id,
            'order_date' => "2023-11-15",
            'order_no' => "1",
            'prefix' => "1",
            'service_id' =>  $serviceData->id,
            //'table_no' => "1",
            // 'room_no' => "1",
            //'guest_id' => "1",
            'gross_amount' => "1",
            'discount_amount' => "1",
            'service_charge' => "1",
            'taxes_amount' => "1",
            'paid_amount' => "1",
            'is_multi_payment' => "1",
            'is_cancel' => "1",
            //'cancel_by' => "1",
            // 'cancel_at' => "1",
            'fo_post' => "1",
            // 'created_by' => "1",
            //'finish_by' => "1",
            'sys_ip' => "1",
            //'last_updated_by' => "1",
            // 'guest_name' => "1",
            'no_of_guest' => $waiterData->id,
            'waiter_id' => "1",
            'qr_code' => "1",
        ]);


        $paymentModeData = PaymentMode::create([
            'name' => "pay1",
            'name_loc' => "pay21"
        ]);
        $PaymentType = PaymentType::create([
            'name' => "pay1",
            'name_loc' => "pay1",
            'payment_mode_id' =>  $paymentModeData->id,
            // 'fo_pay_id' => "1",
            'service_id' =>  $serviceData->id,
            'is_cash' => "0",
            'active' => "1",
        ]);

        $orderPaymentData = [
            "pos_id" => $pos->id,
            "order_master_id" =>  $orderMaster->id,
            "payment_date" => "2023-11-15",
            //inv_store_code:
            //inv_item_code:
            "payment_type_id" => $PaymentType->id,
            "amount" =>  "25",
            "is_cash" => "1",
            // "room_no" => 
            // "guest_id" => 
        ];
        $response = $this->post('/api/order/order-payment', $$orderPaymentData);
        $response->assertStatus(200);
    }

    public function testUpdateFunction(): void
    {
        $pos =  Pos::create([
            "name" => "firstPOS",
            "name_loc" => "firstPOS",
            'phone' => '022503',
        ]);
        $serviceData = Service::create([

            "name" => "service1",
            "name_loc" => "service",

        ]);
        $waiterData = Waiter::create([
            "pos_id" => $pos->id,
            "name" => "waiter",
            "name_loc" => "waiter",

        ]);
        $orderMaster = OrderMaster::create([
            'pos_id' => $pos->id,
            'order_date' => "2023-11-15",
            'order_no' => "1",
            'prefix' => "1",
            'service_id' =>  $serviceData->id,
            //'table_no' => "1",
            // 'room_no' => "1",
            //'guest_id' => "1",
            'gross_amount' => "1",
            'discount_amount' => "1",
            'service_charge' => "1",
            'taxes_amount' => "1",
            'paid_amount' => "1",
            'is_multi_payment' => "1",
            'is_cancel' => "1",
            //'cancel_by' => "1",
            // 'cancel_at' => "1",
            'fo_post' => "1",
            // 'created_by' => "1",
            //'finish_by' => "1",
            'sys_ip' => "1",
            //'last_updated_by' => "1",
            // 'guest_name' => "1",
            'no_of_guest' => "1",
            'waiter_id' =>  $waiterData->id,
            'qr_code' => "1",
        ]);


        $paymentModeData = PaymentMode::create([
            'name' => "pay1",
            'name_loc' => "pay21"
        ]);
        $PaymentType = PaymentType::create([
            'name' => "pay1",
            'name_loc' => "pay1",
            'payment_mode_id' =>  $paymentModeData->id,
            // 'fo_pay_id' => "1",
            'service_id' =>  $serviceData->id,
            'is_cash' => "0",
            'active' => "1",
        ]);

        $orderPaymentData = [
            "pos_id" => $pos->id,
            "order_master_id" =>  $orderMaster->id,
            "payment_date" => "2023-11-15",
            //inv_store_code:
            //inv_item_code:
            "payment_type_id" => $PaymentType->id,
            "amount" =>  "25",
            "is_cash" => "1",
            // "room_no" => 
            // "guest_id" => 
        ];
        $response = $this->post('/api/order/order-payment', $$orderPaymentData);
        $response->assertStatus(200);
    }

    public function testDestroyFunction(): void
    {

        $response = $this->delete('/api/order/order-payment/1');
        $response->assertStatus(200);
    }
}
