<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'category_id' => \App\Models\Category::factory(),
            'location' => fake()->address(),
            'date' => fake()->date(),
            'status' => fake()->randomElement(['pending', 'claimed', 'resolved']),
            'type' => fake()->randomElement(['lost', 'found']),
            'reward' => fake()->optional()->numberBetween(10, 100) . ' USD',
            'contact' => fake()->phoneNumber(),
            'image' => 'items/placeholder.jpg',
            'is_featured' => fake()->boolean(20),
        ];
    }
}
