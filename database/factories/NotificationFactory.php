<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => fake()->sentence(4),
            'message' => fake()->paragraph(),
            'type' => fake()->randomElement(['info', 'success', 'warning', 'error']),
            'read_at' => fake()->optional()->dateTime(),
        ];
    }
}
