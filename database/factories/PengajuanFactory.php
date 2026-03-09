<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\HargaParfum;

class PengajuanFactory extends Factory
{
    public function definition(): array
    {
        return [

            'user_id' => User::factory(),

            'harga_parfum_id' => HargaParfum::inRandomOrder()->value('id'),

            'jenis_parfum' => fake()->randomElement(['EDT','EDP','Extrait']),

            'jumlah' => fake()->numberBetween(50,500),

            'target_market' => fake()->randomElement([
                'Remaja',
                'Dewasa',
                'Premium',
                'Umum'
            ]),

            'catatan' => fake()->sentence(),

            'total_harga' => fake()->numberBetween(1000000,15000000),

            'estimasi_selesai' => fake()->dateTimeBetween('+7 days','+30 days'),

            'status' => fake()->randomElement([
                'pending',
                'proses',
                'selesai',
                'ditolak'
            ]),

        ];
    }
}