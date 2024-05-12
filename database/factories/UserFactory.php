<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fullname' => 'Test user ' . Str::random(3),
            'username' => fake()->userName(),
            'email' => fake()->safeEmail(),
            'password' => Hash::make('123456'),
            'address' =>fake()->address(),
        ];
    }
}
