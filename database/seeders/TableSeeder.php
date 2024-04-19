<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Table::create([
            'pos_id' => '1',
            'name' => 'table1',
            'name_loc' => 'table1_Loc',
            // 'is_used' => 0,

        ]);
    }
}
