<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'menu_id' => Menu::all()->random()->id,
            'title' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->sentence, '-'),
            'short_description' => $this->faker->paragraph,
            'stock' => $this->faker->numberBetween(0, 100),
            'brand' => $this->faker->company,
            'sku' => $this->faker->unique()->ean13,
            'regular_price' => $this->faker->randomFloat(2, 10, 1000),
            'sale_price' => rand(1,100) > 50 ? $this->faker->randomFloat(2, 5, 800) : null,
            'colors' => json_encode([$this->faker->colorName, $this->faker->colorName, $this->faker->colorName]),
            'materials' => json_encode([$this->faker->word, $this->faker->word, $this->faker->word]),
            'pictures' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl(), $this->faker->imageUrl()]),
            'cover_img' => $this->faker->imageUrl(),
            'tags' => json_encode([$this->faker->word, $this->faker->word, $this->faker->word]),
            'long_description' => $this->faker->paragraphs(3, true),
            'specification' => json_encode(['key1' => $this->faker->word, 'key2' => $this->faker->word]),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'amazon_link' => $this->faker->url,
            'insta_link' => $this->faker->url,
        ];
    }
}
