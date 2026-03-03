<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AromaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_kategori' => fake()->randomElement(['Floral','Woody','Fresh','Oriental','Fruity']),
            'biaya_kategori' => fake()->numberBetween(10000,50000),
        ];
    }
}
