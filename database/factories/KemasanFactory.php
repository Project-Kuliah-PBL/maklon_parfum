<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KemasanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'jenis_botol' => fake()->randomElement(['Spray','Roll On','Pump']),
            'ukuran' => fake()->randomElement(['30ml','50ml','100ml']),
            'jenis_box' => fake()->randomElement(['Hardbox','Softbox','Exclusive Box']),
            'catatan' => fake()->sentence(),
            'biaya_kemasan' => fake()->numberBetween(10000,50000),
        ];
    }
}
