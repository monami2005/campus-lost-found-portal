<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_id' => \App\Models\Item::factory(),
            'user_id' => \App\Models\User::factory(),
            'reason' => fake()->randomElement(['Spam', 'Inappropriate content', 'False information', 'Other']),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement(['pending', 'reviewed', 'resolved']),
        ];
    }
}
