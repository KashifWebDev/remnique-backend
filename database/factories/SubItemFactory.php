<?php

namespace Database\Factories;

use App\Models\MenuSub;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubItem>
 */
class SubItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => $this->faker->words(2, true),
            'url' => '/shop/catalog',
            'parent_id' => MenuSub::all()->random()->id
        ];
    }
}
