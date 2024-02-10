<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->sentence,
            'short_description' => $this->faker->paragraph,
            'availability' => $this->faker->randomElement(['In Stock', 'Out Of Stock']),
            'brand' => $this->faker->word,
            'sku' => $this->faker->unique()->ean13,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'color' => $this->faker->colorName,
            'material' => $this->faker->word,
            'pictures' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl()]),
            'tags' => json_encode([$this->faker->word, $this->faker->word]),
            'long_description' => $this->faker->paragraphs(3, true),
            'specification' => json_encode([
                'General' => [
                    'Key1' => $this->faker->word,
                    'Key2' => $this->faker->word,
                ],
                'Dimensions' => [
                    'Length' => $this->faker->randomFloat(2, 1, 10),
                    'Width' => $this->faker->randomFloat(2, 1, 10),
                    'Height' => $this->faker->randomFloat(2, 1, 10),
                ],
            ]),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'amazon_link' => rand(0,10) > 5 ? $this->faker->url() : '',
            'insta_link' => rand(0,10) > 5 ? $this->faker->url() : '',
        ];
    }
}
