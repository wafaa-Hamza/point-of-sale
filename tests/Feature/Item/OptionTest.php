<?php

namespace Tests\Feature\Item;

use App\Models\Pos;
use Tests\TestCase;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\ItemSubCategory;
use Database\Factories\ItemFactory;
use Database\Factories\General\PosFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OptionTest extends TestCase
{
  //  use RefreshDatabase;

    public function testIndexFunction(): void
    {
        $response = $this->get('/api/item/option');
        $response->assertStatus(200);
    }
    public function testShowFunction(): void
    {
        $response = $this->get('/api/item/option/1');
        $response->assertStatus(200);
    }
    public function testStoreFunction(): void
    {
        $pos =  Pos::create([
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'phone'=>'022503',
        ]);

        $category = ItemCategory::create([
            'pos_id' => $pos->id,
            'name' => "firstPOS",
            'name_loc' => "firstPOS",
            'color' => "firstPOS",
        ]);
        $subCategory = ItemSubCategory::create([
            'pos_id' => $pos->id,
            'name' => "firstPOS",
            'name_loc' => "firstPOS",
            "category_id" =>  $category->id,
            'color' => "firstPOS",
        ]);

        $item = Item::create([
            "name" => "item1",
            "name_loc" => "item1",
            "pos_id" => $pos->id,
            "cost" => "2",
            //inv_store_code:
            //inv_item_code:
            "kitchen_printer" => "As",
            "category_id" =>  $category->id,
            "sub_category_id" =>  $subCategory->id,
           // "active" => 
        ]);

        $data = [
            "name"=>"option",
            "name_loc" => "option",
            'pos_id' => $pos->id,
            'item_id' => $item->id,
        ];
        $response = $this->post('/api/item/option',$data);
        $response->assertStatus(200);
    }
    public function testUpdateFunction(): void
    {
        $pos =  Pos::create([
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'phone'=>'022503',
        ]);

        $category = ItemCategory::create([
            'pos_id' => $pos->id,
            'name' => "firstPOS",
            'name_loc' => "firstPOS",
            'color' => "firstPOS",
        ]);
        $subCategory = ItemSubCategory::create([
            'pos_id' => $pos->id,
            'name' => "firstPOS",
            'name_loc' => "firstPOS",
            "category_id" =>  $category->id,
            'color' => "firstPOS",
        ]);

        $item = Item::create([
            "name" => "item1",
            "name_loc" => "item1",
            "pos_id" => $pos->id,
            "cost" => "2",
            //inv_store_code:
            //inv_item_code:
            "kitchen_printer" => "As",
            "category_id" =>  $category->id,
            "sub_category_id" =>  $subCategory->id,
           // "active" => 
        ]);

        $data = [
            "name"=>"option",
            "name_loc" => "option",
            'pos_id' => $pos->id,
            'item_id' => $item->id,
        ];
        $response = $this->put('/api/item/option/1',$data);
        $response->assertStatus(200);
    }
    public function testDestroyFunction(): void
    {

        $response = $this->delete('/api/item/option/1');
        $response->assertStatus(200);
    }
}