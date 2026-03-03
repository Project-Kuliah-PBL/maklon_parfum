<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HargaParfumFactory extends Factory
{
    public function definition(): array
    {
        return [
            'jenis_parfum' => fake()->randomElement(['EDT','EDP','Extrait']),
            'harga_per_ml' => fake()->randomFloat(2,1500,5000),
        ];
    }
}
