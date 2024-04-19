<?php

namespace Database\Factories\General;

use App\Models\Pos;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $factory->define(Pos::class, function (Faker $faker) {
            return [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
            ];});
        // return [
        //     "name"=>"firstPOS",
        //     "name_loc" => "firstPOS",
        //     'phone' => "012345",
        // ];
    }
}
