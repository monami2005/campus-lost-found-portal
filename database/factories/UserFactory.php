<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

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
    public function definition(Faker $faker): array
    {
        return [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'phone' => $faker->phoneNumber(),
            'department' => $faker->randomElement([
                'Computer Science',
                'Engineering',
                'Business',
                'Arts',
                'Science'
            ]),
            'semester' => $faker->randomElement([
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
            'bio' => $faker->sentence(),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ];
    }
}