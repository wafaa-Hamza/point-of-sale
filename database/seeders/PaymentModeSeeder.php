<?php

namespace Database\Seeders;

use App\Models\PaymentMode;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMode::create([
            'name' => 'Cash',
            'name_loc' => 'Cash_Loc'
        ]);
        PaymentMode::create([
            'name' => 'Card',
            'name_loc' => 'Card_loc'
        ]);
        PaymentMode::create([
            'name' => 'Credit',
            'name_loc' => 'Credit_loc'
        ]);
    }
}
