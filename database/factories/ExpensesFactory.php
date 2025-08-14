<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expenses>
 */
class ExpensesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->sentence(3),
            'amount' => fake()->randomFloat(2, 5, 500),
            'date' => fake()->dateTimeBetween('2021-01-01', now()),
            'category' => fake()->randomElement(['shopping', 'medical', 'entertainment', 'food', 'transport', 'bills']),
            'user_id' => User::factory(),
        ];
    }
}
