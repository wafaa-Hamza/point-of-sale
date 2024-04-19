<?php

namespace Database\Seeders;

use App\Models\ItemSubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSubCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCatData = [
            "name"=>"firstPOS",
            "name_loc" => "firstPOS",
            'color' => "red",
            'pos_id' => "1",
            'category_id' => "1",
        ];
        ItemSubCategory::created($subCatData);
    }
}
