<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Departments
        $powerTools = Menu::create([
            'label' => 'Power Tools',
            'url' => '/shop/catalog',
            'menu_type' => 'megamenu',
            'size' => 'xl',
            'visibility' => rand(0, 5) > 3,
            'page_title' => 'Page Title here..',
            'meta_desc' => 'SOme random meta desc here'
        ]);
        // Add submenus for Power Tools
        $powerTools->children()->createMany([
            ['label' => 'Engravers', 'url' => '/shop/catalog'],
            ['label' => 'Drills', 'url' => '/shop/catalog'],
            ['label' => 'Wrenches', 'url' => '/shop/catalog'],
            ['label' => 'Plumbing', 'url' => '/shop/catalog'],
            ['label' => 'Wall Chaser', 'url' => '/shop/catalog'],
            ['label' => 'Pneumatic Tools', 'url' => '/shop/catalog'],
            ['label' => 'Milling Cutters', 'url' => '/shop/catalog'],
        ]);

        // Hand Tools
        $handTools = Menu::create([
            'label' => 'Hand Tools',
            'url' => '/shop/catalog',
            'menu_type' => 'megamenu',
            'size' => 'lg',
            // Add more fields as needed
        ]);
        // Add submenus for Hand Tools
        $handTools->children()->createMany([
            ['label' => 'Screwdrivers', 'url' => '/shop/catalog'],
            ['label' => 'Handsaws', 'url' => '/shop/catalog'],
            ['label' => 'Knives', 'url' => '/shop/catalog'],
            ['label' => 'Axes', 'url' => '/shop/catalog'],
            ['label' => 'Multitools', 'url' => '/shop/catalog'],
            ['label' => 'Paint Tools', 'url' => '/shop/catalog'],
        ]);

        // Add more departments and their respective submenus as needed
    }
}
