<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();

        return [
            'category_id' => BlogCategory::all()->random()->id,
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'description' => $this->faker->sentence(5),
            'cover_image' => $this->faker->imageUrl(),
            'content' => $this->faker->text(),
            'status' => $this->faker->randomElement(['draft', 'publish']),
            'tags' => json_encode([
                $this->faker->randomElements(
                    [
                        "house",
                        "flat",
                        "apartment",
                        "room", "shop",
                        "lot", "garage"
                    ],
                    rand(1,5)
                )
            ]),
            'user_id' => User::all()->random()->id,
            'featured' => rand(0, 10) > 5
        ];
    }
}
