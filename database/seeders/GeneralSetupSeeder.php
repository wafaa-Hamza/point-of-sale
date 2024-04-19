<?php

namespace Database\Seeders;

use App\Models\GeneralSetup;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeneralSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GeneralSetup::create([
            'pos_id' => 1,
            'pos_date' => Carbon::now(),
            'is_inventory' => 0,
            'is_kitchen_printer' => 0,
            'pos_room_id' => null,
            'vat_number' => null,
        ]);
    }
}
