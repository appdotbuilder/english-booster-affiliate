<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\Commission;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commission>
 */
class CommissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rate = $this->faker->randomFloat(2, 10, 30);
        $orderAmount = $this->faker->randomFloat(2, 100000, 5000000);
        $commissionAmount = ($orderAmount * $rate) / 100;

        return [
            'affiliate_id' => Affiliate::factory(),
            'order_id' => Order::factory(),
            'commission_rate' => $rate,
            'commission_amount' => $commissionAmount,
            'status' => $this->faker->randomElement(['pending', 'approved', 'paid', 'cancelled']),
            'tier_at_time' => $this->faker->randomElement(['bronze', 'silver', 'gold', 'platinum']),
            'approved_at' => $this->faker->optional(0.6)->dateTimeBetween('-6 months', 'now'),
            'paid_at' => $this->faker->optional(0.3)->dateTimeBetween('-3 months', 'now'),
            'calculation_details' => [
                'base_amount' => $orderAmount,
                'rate_applied' => $rate,
                'tier_bonus' => 0,
            ],
        ];
    }

    /**
     * Indicate that the commission is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'approved_at' => null,
            'paid_at' => null,
        ]);
    }

    /**
     * Indicate that the commission is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'approved_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'paid_at' => null,
        ]);
    }
}