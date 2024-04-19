<?php

namespace Database\Seeders;

use App\Models\Waiter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Waiter::create([
            'pos_id' => '1',
            'name' => 'ويتر',
            'name_loc' => 'waiter',


        ]);
    }
}
