<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_note' => fake()->word(),
            'kategori_note' => fake()->randomElement(['Top','Middle','Base']),
            'biaya_note' => fake()->numberBetween(5000,20000),
        ];
    }
}
