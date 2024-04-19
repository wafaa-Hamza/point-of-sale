<?php

namespace Tests\Feature\Payment;

use App\Models\Pos;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaxTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexFunction(): void
    {
        $response = $this->get('/api/payment/tax');
        $response->assertStatus(200);
    }
    public function testShowFunction(): void
    {
        $response = $this->get('/api/payment/tax/1');
        $response->assertStatus(200);
    }
    public function testStoreFunction(): void
    {
      $pos =  Pos::create([
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'phone'=>'022503',
        ]);
        
        $data = [
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'pos_id' => $pos->id,
            'per' =>'dsd',
            'amount' => 20,
            'formula' =>20,
           'extra' => 'sds',
            'accept_per' =>'0'
        ];
        $response = $this->post('/api/payment/tax',$data);
        $response->assertStatus(200);
    }
    public function testUpdateFunction(): void
    {
        $pos =  Pos::create([
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'phone'=>'022503',
        ]);
        $data = [
            "name"=>"firstPOSrr",
            "name_loc" => "firstPOS",
            'pos_id' => $pos->id,
            'per' =>'dsd',
            'amount' => 20,
            'formula' =>'sds',
            'extra' => 'sds',
            'accept_per' =>true
        ];
        $response = $this->put('/api/payment/tax/1',$data);
        $response->assertStatus(200);
    }
    public function testDestroyFunction(): void
    {
        $data = [
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'phone' => "012345",
        ];
        $response = $this->delete('/api/payment/tax/1',$data);
        $response->assertStatus(200);
    }
}