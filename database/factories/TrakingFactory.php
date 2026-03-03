<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TrakingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tahapan' => fake()->randomElement(['Produksi','Pengemasan','Pengiriman']),
            'catatan' => fake()->sentence(),
            'status' => fake()->randomElement(['progress','done','reject']),
            'tanggal' => fake()->date(),
        ];
    }
}
