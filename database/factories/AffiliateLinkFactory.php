<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\AffiliateLink;
use App\Models\AffiliateProgram;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AffiliateLink>
 */
class AffiliateLinkFactory extends Factory
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
            'affiliate_program_id' => AffiliateProgram::factory(),
            'link_code' => Str::random(12),
            'original_url' => $this->faker->url(),
            'campaign' => $this->faker->word(),
            'clicks' => $this->faker->numberBetween(0, 100),
            'conversions' => $this->faker->numberBetween(0, 10),
            'is_active' => $this->faker->boolean(90),
        ];
    }

    /**
     * Indicate that the link is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }
}