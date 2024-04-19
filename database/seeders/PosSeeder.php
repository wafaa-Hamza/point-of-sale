<?php

namespace Database\Seeders;

use App\Models\Pos;
use Illuminate\Database\Seeder;
use Database\Factories\General\PosFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pos = PosFactory::new()->count(1)->create();
        // $data = [
        //     "name"=>"firstPOS",
        //     "name_loc" => "firstPOS",
        //     'phone' => "012345",
        // ];
       // Pos::create($data);
    }
}
