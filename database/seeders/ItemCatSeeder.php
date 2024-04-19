<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catData = [
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'color' => "red",
            'pos_id' => "1",
            
        ];
        ItemCategory::create($catData);
    }
}
