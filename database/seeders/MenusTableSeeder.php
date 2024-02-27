<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create menus
        $menu1 = Menu::factory()->create([
            'label' => 'Building Supplies1',
            'url' => '/shop/catalog',
        ]);

        $menu2 = Menu::factory()->create([
            'label' => 'Electrical2',
            'url' => '/shop/catalog',
        ]);

        $menu3 = Menu::factory()->create([
            'label' => 'Kashif',
            'url' => '/shop/catalog',
        ]);

        $menu1->items()->createMany([
            ['label' => 'Screwdrivers', 'url' => '/shop/catalog'],
            ['label' => 'Handsaws', 'url' => '/shop/catalog'],
            ['label' => 'Knives', 'url' => '/shop/catalog'],
            ['label' => 'Axes', 'url' => '/shop/catalog'],
            ['label' => 'Multitools', 'url' => '/shop/catalog'],
            ['label' => 'Paint Tools', 'url' => '/shop/catalog'],
        ]);

        $menu2->items()->createMany([
            ['label' => 'Sub men1', 'url' => '/shop/catalog'],
            ['label' => 'Sub Men 3', 'url' => '/shop/catalog'],
        ]);

        $menu3->items()->createMany([
            ['label' => 'Ali', 'url' => '/shop/catalog'],
        ]);

        $menu1->items()->first()->items()->createMany([
            ['label' => 'Engravers', 'url' => '/shop/catalog'],
            ['label' => 'Drills', 'url' => '/shop/catalog'],
            ['label' => 'Wrenches', 'url' => '/shop/catalog'],
            ['label' => 'Plumbing', 'url' => '/shop/catalog'],
            ['label' => 'Wall Chaser', 'url' => '/shop/catalog'],
            ['label' => 'Pneumatic Tools', 'url' => '/shop/catalog'],
            ['label' => 'Milling Cutters', 'url' => '/shop/catalog'],
        ]);

        $menu2->items()->first()->items()->createMany([
            ['label' => 'Screwdrivers', 'url' => '/shop/catalog'],
            ['label' => 'Handsaws', 'url' => '/shop/catalog'],
            ['label' => 'Knives', 'url' => '/shop/catalog'],
            ['label' => 'Axes', 'url' => '/shop/catalog'],
            ['label' => 'Multitools', 'url' => '/shop/catalog'],
            ['label' => 'Paint Tools', 'url' => '/shop/catalog'],
        ]);

    }
}
