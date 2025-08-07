<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\Payout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payout>
 */
class PayoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'affiliate_id' => Affiliate::factory(),
            'payout_number' => 'PAY-' . $this->faker->unique()->numerify('######'),
            'amount' => $this->faker->randomFloat(2, 100000, 5000000),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'failed']),
            'method' => $this->faker->randomElement(['bank_transfer', 'manual']),
            'bank_name' => $this->faker->randomElement([
                'BCA (Bank Central Asia)',
                'BRI (Bank Rakyat Indonesia)', 
                'BNI (Bank Negara Indonesia)',
                'Mandiri',
            ]),
            'bank_account_number' => $this->faker->numerify('##########'),
            'bank_account_holder' => $this->faker->name(),
            'notes' => $this->faker->optional()->sentence(),
            'commission_ids' => [$this->faker->numberBetween(1, 100)],
            'processed_at' => $this->faker->optional(0.5)->dateTimeBetween('-3 months', 'now'),
        ];
    }

    /**
     * Indicate that the payout is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'processed_at' => null,
        ]);
    }

    /**
     * Indicate that the payout is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'processed_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ]);
    }
}