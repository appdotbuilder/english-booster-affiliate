<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\AffiliateProgram;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => 'ORD-' . $this->faker->unique()->numerify('######'),
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->safeEmail(),
            'customer_phone' => $this->faker->phoneNumber(),
            'affiliate_program_id' => AffiliateProgram::factory(),
            'affiliate_id' => Affiliate::factory(),
            'total_amount' => $this->faker->randomFloat(2, 100000, 5000000),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled', 'refunded']),
            'payment_method' => $this->faker->randomElement(['bank_transfer', 'credit_card', 'e_wallet']),
            'coupon_code' => $this->faker->optional(0.3)->regexify('[A-Z]{4}[0-9]{2}'),
            'attribution_type' => $this->faker->randomElement(['first_click', 'last_click']),
            'tracking_data' => [
                'utm_source' => 'affiliate',
                'utm_medium' => 'link',
                'utm_campaign' => $this->faker->word(),
            ],
            'confirmed_at' => $this->faker->optional(0.7)->dateTimeBetween('-6 months', 'now'),
        ];
    }

    /**
     * Indicate that the order is confirmed.
     */
    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'confirmed',
            'confirmed_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    /**
     * Indicate that the order is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'confirmed_at' => null,
        ]);
    }
}