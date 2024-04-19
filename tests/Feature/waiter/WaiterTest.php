<?php

namespace Tests\Feature\waiter;

use App\Models\Pos;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WaiterTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexFunction(): void
    {
        $response = $this->get('/api/waiter/waiter');
        $response->assertStatus(200);
    }
    public function testShowFunction(): void
    {
        $response = $this->get('/api/waiter/waiter/1');
        $response->assertStatus(200);
    }

    public function testStoreFunction(): void
    {
        $pos =  Pos::create([
            "name" => "firstPOS",
            "name_loc" => "firstPOS",
            'phone' => '022503',
        ]);
        $waiterData = [
            "pos_id" => $pos->id,
            "name" => "waiter",
            "name_loc" => "waiter",

        ];
        $response = $this->post('/api/waiter/waiter', $waiterData);
        $response->assertStatus(200);
    }
    public function testUpdateFunction(): void
    {
        $pos =  Pos::create([
            "name" => "firstPOS",
            "name_loc" => "firstPOS",
            'phone' => '022503',
        ]);
        $waiterData = [
            "pos_id" => $pos->id,
            "name" => "waiter",
            "name_loc" => "waiter",

        ];
        $response = $this->post('/api/waiter/waiter', $waiterData);
        $response->assertStatus(200);
    }

    public function testDestroyFunction(): void
    {

        $response = $this->delete('/api/waiter/waiter/1');
        $response->assertStatus(200);
    }
}
