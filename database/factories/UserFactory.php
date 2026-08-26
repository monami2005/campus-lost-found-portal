<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'phone' => fake()->phoneNumber(),
            'department' => fake()->randomElement(['Computer Science', 'Engineering', 'Business', 'Arts', 'Science']),
            'semester' => fake()->randomElement(['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th']),
            'role' => 'student',
            'status' => 'active',
            'bio' => fake()->sentence(),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ];
    }
}
