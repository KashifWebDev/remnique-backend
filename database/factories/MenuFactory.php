<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{

    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *     <?php
     *
     * namespace Database\Factories;
     *
     * use App\Models\Menu;
     * use Illuminate\Database\Eloquent\Factories\Factory;
     *
     * /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
     * /
     * class MenuFactory extends Factory
     * {
     *
     * protected $model = Menu::class;
     *
     * /**
     *  Define the model's default state.
     *
     * @return array<string, mixed>
     * /
     *
     * public function definition(): array
     * {
     * return [
     * 'label' => $this->faker->words(2, true),
     * 'url' => '/shop/catalog',
     * 'menu_type' => 'megamenu',
     * 'image' => 'assets/images/megamenu/megamenu-' . $this->faker->numberBetween(1, 3) . '.jpg',
     * 'size' => $this->faker->randomElement(['xl', 'lg', 'nl', 'sm']),
     * 'visibility' => rand(0, 5) > 3,
     * 'page_title' => $this->faker->words(rand(2, 5), true),
     * 'meta_desc' => $this->faker->sentence()
     * ];
     * }
     * }
     *
     *
     */

    public function definition(): array
    {
        return [
            'label' => $this->faker->words(2, true),
            'url' => '/shop/catalog',
//            'menu_type' => 'megamenu',
//            'image' => 'assets/images/megamenu/megamenu-' . $this->faker->numberBetween(1, 3) . '.jpg',
//            'size' => $this->faker->randomElement(['xl', 'lg', 'nl', 'sm']),
//            'visibility' => rand(0, 5) > 3,
//            'page_title' => $this->faker->words(rand(2, 5), true),
//            'meta_desc' => $this->faker->sentence()
        ];
    }
}
