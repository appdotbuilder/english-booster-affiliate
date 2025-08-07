<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Affiliate>
 */
class AffiliateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Affiliate>
     */
    protected $model = Affiliate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'affiliate_code' => 'EB-' . Str::upper(Str::random(8)),
            'full_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'bank_name' => $this->faker->randomElement([
                'BCA (Bank Central Asia)',
                'BRI (Bank Rakyat Indonesia)', 
                'BNI (Bank Negara Indonesia)',
                'Mandiri',
                'CIMB Niaga',
            ]),
            'bank_account_number' => $this->faker->numerify('##########'),
            'bank_account_holder' => $this->faker->name(),
            'status' => $this->faker->randomElement(['pending', 'active', 'inactive']),
            'tier' => $this->faker->randomElement(['bronze', 'silver', 'gold', 'platinum']),
            'total_commissions_earned' => $this->faker->randomFloat(2, 0, 10000000),
            'total_commissions_paid' => $this->faker->randomFloat(2, 0, 5000000),
            'minimum_payout' => 100000,
            'marketing_preferences' => [
                'banners' => true,
                'captions' => true,
                'videos' => $this->faker->boolean(),
            ],
            'approved_at' => $this->faker->optional(0.7)->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Indicate that the affiliate is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'approved_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    /**
     * Indicate that the affiliate is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'approved_at' => null,
        ]);
    }
}