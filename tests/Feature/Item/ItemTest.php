<?php

namespace Tests\Feature\Item;

use App\Models\Pos;
use Tests\TestCase;
use App\Models\ItemCategory;
use App\Models\ItemSubCategory;
use Database\Factories\ItemFactory;
use Illuminate\Support\Facades\Artisan;
use Database\Factories\General\PosFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexFunction(): void
    {
        $response = $this->get('/api/item/item');
        $response->assertStatus(200);
    }
    public function testShowFunction(): void
    {
        $response = $this->get('/api/item/item/1');
        $response->assertStatus(200);
    }
    public function testStoreCategoryFunction(): void
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

        $itemData = [
            "name" => "item1",
            "name_loc" => "item1",
            "pos_id" => $pos->id,
            "cost" => "2",
            //inv_store_code:
            //inv_item_code:
            "kitchen_printer" => "As",
            "category_id" =>  $category->id,
            "sub_category_id" => "1",
           // "active" => 
        ];
        $response = $this->post('/api/item/itemcategory',$itemData);
        $response->assertStatus(200);
    }
    public function testStoreSubCategoryFunction(): void
    {
        $subCatData = [
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'color' => "red",
            'pos_id' => "1",
            'category_id' => "1",
        ];
        $response = $this->post('/api/item/itemsubcategory',$subCatData);

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

        $itemData = [
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
        ];
        $response = $this->post('/api/item/item',$itemData);   
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

        $itemData = [
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
        ];
        $response = $this->put('/api/item/item/1',$itemData);
        $response->assertStatus(200);
    }
    public function testDestroyFunction(): void
    {

        $response = $this->delete('/api/item/item/1');
        $response->assertStatus(200);
    }
}