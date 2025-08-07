<?php

namespace Database\Factories;

use App\Models\MarketingMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MarketingMaterial>
 */
class MarketingMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['banner', 'caption', 'poster', 'video', 'landing_page']);
        
        $formats = [
            'banner' => 'jpg',
            'caption' => 'text',
            'poster' => 'jpg',
            'video' => 'mp4',
            'landing_page' => 'html',
        ];

        return [
            'title' => $this->faker->words(3, true),
            'type' => $type,
            'format' => $formats[$type],
            'content' => $type === 'caption' ? $this->faker->paragraphs(3, true) : null,
            'file_path' => $type !== 'caption' ? '/' . $type . 's/' . $this->faker->word() . '.' . $formats[$type] : null,
            'preview_image' => $type === 'video' ? '/videos/previews/' . $this->faker->word() . '.jpg' : null,
            'dimensions' => in_array($type, ['banner', 'poster', 'video']) ? [
                'width' => $this->faker->numberBetween(800, 1920),
                'height' => $this->faker->numberBetween(400, 1080),
            ] : null,
            'program_types' => $this->faker->randomElements(['online', 'offline', 'group', 'branch'], random_int(1, 3)),
            'description' => $this->faker->sentence(),
            'download_count' => $this->faker->numberBetween(0, 500),
            'is_active' => $this->faker->boolean(85),
        ];
    }

    /**
     * Indicate that the material is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }
}