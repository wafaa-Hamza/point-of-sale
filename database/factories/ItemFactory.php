<?php

namespace Database\Factories;

use Database\Factories\General\PosFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pos = PosFactory::new()->count(1)->create();
        return [
            "name" => "item1",
            "name_loc" => "item1",
            "pos_id" => $pos->id,
            "cost" => "2",
            //inv_store_code:
            //inv_item_code:
            "kitchen_printer" => "As",
            "category_id" => "1",
            "sub_category_id" => "1",
           // "active" => 
        ];
    }
}