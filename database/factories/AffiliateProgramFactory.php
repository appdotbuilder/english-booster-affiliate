<?php

namespace Database\Factories;

use App\Models\AffiliateProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AffiliateProgram>
 */
class AffiliateProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\AffiliateProgram>
     */
    protected $model = AffiliateProgram::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['online', 'offline', 'group', 'branch'];
        $type = $this->faker->randomElement($types);
        
        $categories = [
            'online' => ['Kids', 'Teen', 'TOEFL', 'General English', 'Speaking Booster'],
            'offline' => ['2-week', '1-month', '2-month', '3-month', 'TOEFL'],
            'group' => ['English Trip', 'Special English Day', 'Tutor Visit'],
            'branch' => ['Cilukba', 'Hompimpa', 'Hip Hip Hurray', 'Insight Out'],
        ];
        
        $locations = ['Kediri', 'Malang', 'Sidoarjo', 'Nganjuk'];
        
        return [
            'name' => $this->faker->words(3, true) . ' Program',
            'type' => $type,
            'category' => $this->faker->randomElement($categories[$type]),
            'location' => in_array($type, ['offline', 'branch']) ? $this->faker->randomElement($locations) : null,
            'description' => $this->faker->sentence(10),
            'base_price' => $this->faker->numberBetween(500000, 5000000),
            'commission_rate' => $this->faker->randomFloat(2, 10, 30),
            'is_active' => $this->faker->boolean(85),
        ];
    }

    /**
     * Indicate that the program is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the program is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}