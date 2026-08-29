<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'phone' => $this->faker->phoneNumber(),
            'department' => $this->faker->randomElement([
                'Computer Science',
                'Engineering',
                'Business',
                'Arts',
                'Science'
            ]),
            'semester' => $this->faker->randomElement([
                '1st',
                '2nd',
                '3rd',
                '4th',
                '5th',
                '6th',
                '7th',
                '8th'
            ]),
            'role' => 'student',
            'status' => 'active',
            'bio' => $this->faker->sentence(),
            'remember_token' => Str::random(10),
        ];
    }
}