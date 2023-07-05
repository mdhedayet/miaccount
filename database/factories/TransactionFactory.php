<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'account_head_id' => $this->faker->numberBetween(1, 8),
            'date' => $this->faker->date(),
            'debit' => $this->faker->numberBetween(50, 100),
            'credit' => $this->faker->numberBetween(0, 50),
        ];
    }
}
