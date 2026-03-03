<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PengajuanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'jenis_parfum' => fake()->randomElement(['EDT','EDP','Extrait']),
            'jumlah' => fake()->numberBetween(50,500),
            'target_market' => fake()->randomElement(['Remaja','Dewasa','Premium','Umum']),
            'catatan' => fake()->sentence(),
            'status' => fake()->randomElement(['pending','proses','selesai','ditolak']),
        ];
    }
}
