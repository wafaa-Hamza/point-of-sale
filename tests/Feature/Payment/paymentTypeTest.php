<?php

namespace Tests\Feature\payment;

use Tests\TestCase;
use App\Models\PaymentMode;
use App\Models\PaymentType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class paymentTypeTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexFunction(): void
    {
        $response = $this->get('/api/payment/payment-type');
        $response->assertStatus(200);
    }
    public function testShowFunction(): void
    {
        $response = $this->get('/api/payment/payment-type/1');
        $response->assertStatus(200);
    }

    public function testStoreFunction(): void
    {
        $paymentModeData = PaymentMode::create([
            'name' => "pay1",
            'name_loc' => "pay21"
        ]);
        $paymentData = [
            "name" => "item1",
            "name_loc" => "item1",
            "type" => "type",
            "cost" => "2",
            "payment_mode_id" => $paymentModeData->id,
            "gl_account" =>  "account",
            // "fo_pay_id" => "1",
            "is_cash" => "0",
            "active" => "1"
        ];
        $response = $this->post('/api/payment/payment-type/1', $paymentData);
        $response->assertStatus(405);
    }

    public function testUpdateFunction(): void
    {
        $paymentModeData = PaymentMode::create([
            'name' => "pay1",
            'name_loc' => "pay21"
        ]);
        $paymentData = [
            "name" => "item1",
            "name_loc" => "item1",
            "type" => "type",
            "cost" => "2",
            "payment_mode_id" => $paymentModeData->id,
            "gl_account" =>  "account",
            // "fo_pay_id" => "1",
            "is_cash" => "0",
            "active" => "1"
        ];
        $response = $this->put('/api/payment/payment-type/1', $paymentData);
        $response->assertStatus(200);
    }
    public function testDestroyFunction(): void
    {

        $response = $this->delete('/api/payment/payment-type/1');
        $response->assertStatus(200);
    }
}
