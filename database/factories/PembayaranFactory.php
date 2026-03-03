<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PembayaranFactory extends Factory
{
    public function definition(): array
    {
        return [
            'metode_pembayaran' => fake()->randomElement(['Transfer BCA','Transfer Mandiri','QRIS','COD']),
            'total' => fake()->randomFloat(2,1000000,10000000),
            'tanggal_pembayaran' => fake()->date(),
            'status_bayar' => fake()->randomElement(['unpaid','paid','failed']),
        ];
    }
}
