<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\AffiliateClick;
use App\Models\AffiliateLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AffiliateClick>
 */
class AffiliateClickFactory extends Factory
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
            'affiliate_link_id' => AffiliateLink::factory(),
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'referrer' => $this->faker->optional()->url(),
            'utm_source' => $this->faker->optional()->word(),
            'utm_medium' => $this->faker->optional()->word(),
            'utm_campaign' => $this->faker->optional()->word(),
            'session_id' => $this->faker->uuid(),
            'tracking_data' => [
                'query_params' => [],
                'headers' => [],
            ],
        ];
    }
}