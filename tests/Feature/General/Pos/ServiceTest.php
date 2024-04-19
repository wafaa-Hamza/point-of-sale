<?php

namespace Tests\Feature\General;

use App\Models\Pos;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexFunction(): void
    {
        $response = $this->get('/api/general/services');
        $response->assertStatus(200);
    }
    public function testShowFunction(): void
    {
        $response = $this->get('/api/general/services/1');
        $response->assertStatus(200);
    }


    public function testStoreFunction(): void
    {

        $serviceData = [

            "name" => "service1",
            "name_loc" => "service",

        ];
        $response = $this->post('/api/general/services', $serviceData);
        $response->assertStatus(200);
    }
    public function testUpdateFunction(): void
    {

        $serviceData = [

            "name" => "service",
            "name_loc" => "service",

        ];
        $response = $this->post('/api/general/services', $serviceData);
        $response->assertStatus(200);
    }

    public function testDestroyFunction(): void
    {

        $response = $this->delete('/api/general/services/1');
        $response->assertStatus(200);
    }
}
