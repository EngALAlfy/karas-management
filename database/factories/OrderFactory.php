<?php

namespace Database\Factories;

use Carbon\Carbon;
use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
         'number' => $this->faker->randomNumber(),
        'date' => $this->faker->dateTimeBetween('last week' , 'now'),
        'tawkeel_id' => 1,
        'mekawel_id' => 1,
        'name' => 'اسلام حسن',
        's_w' => 's',
        'count_40' => 66,
        'count_20' => 8,
        'h_t' => 89,
        'grant' => 'الباشات',
        ];
    }
}
