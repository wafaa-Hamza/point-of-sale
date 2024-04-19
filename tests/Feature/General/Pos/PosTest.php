<?php

namespace Tests\Feature\General\Pos;

use Tests\TestCase;
use App\RepoInterface\General\PosInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PosTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexFunction(): void
    {
        $response = $this->get('/api/general/pos');
        $response->assertStatus(200);
    }
    public function testShowFunction(): void
    {
        $response = $this->get('/api/general/pos/1');
        $response->assertStatus(200);
    }
    public function testStoreFunction(): void
    {
        $data = [
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'phone' => "012345",
        ];
        $response = $this->post('/api/general/pos',$data);
        $response->assertStatus(200);
    }
    public function testUpdateFunction(): void
    {
        $data = [
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'phone' => "012345",
        ];
        $response = $this->put('/api/general/pos/1',$data);
        $response->assertStatus(200);
    }
    public function testDestroyFunction(): void
    {
        $data = [
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'phone' => "012345",
        ];
        $response = $this->delete('/api/general/pos/1',$data);
        $response->assertStatus(200);
    }
}
