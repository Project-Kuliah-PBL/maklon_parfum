<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'username' => fake()->unique()->userName(),
            'nama_brand' => fake()->company(),
            'role' => fake()->randomElement(['admin','customer']),
            'no_telp' => fake()->numerify('08##########'),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ];
    }
}
