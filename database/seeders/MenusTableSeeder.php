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
            'label' => 'Building Supplies',
            'url' => '/shop/catalog',
            'menu_type' => 'megamenu',
            'size' => 'sm',
        ]);

        $menu2 = Menu::factory()->create([
            'label' => 'Electrical',
            'url' => '/shop/catalog',
            'menu_type' => 'menu',
        ]);

        // Create menu items for menu1
        $handTools = MenuItem::factory()->create([
            'label' => 'Hand Tools',
            'url' => '/shop/catalog',
            'menu_id' => $menu1->id,
        ]);

        $gardenEquipment = MenuItem::factory()->create([
            'label' => 'Garden Equipment',
            'url' => '/shop/catalog',
            'menu_id' => $menu1->id,
        ]);

        // Create menu items for menu2
        $solderingEquipment = MenuItem::factory()->create([
            'label' => 'Soldering Equipment',
            'url' => '/shop/catalog',
            'menu_id' => $menu2->id,
        ]);

        DB::enableQueryLog();
//        // Add children for menu1
        $handTools->children()->createMany([
            ['label' => 'Screwdrivers', 'url' => '/shop/catalog'],
            ['label' => 'Handsaws', 'url' => '/shop/catalog'],
            ['label' => 'Knives', 'url' => '/shop/catalog'],
            ['label' => 'Axes', 'url' => '/shop/catalog'],
            ['label' => 'Multitools', 'url' => '/shop/catalog'],
            ['label' => 'Paint Tools', 'url' => '/shop/catalog'],
        ]);
        dd(DB::getQueryLog()); // Show results of log
//
//        $gardenEquipment->children()->createMany([
//            ['label' => 'Motor Pumps', 'url' => '/shop/catalog'],
//            ['label' => 'Chainsaws', 'url' => '/shop/catalog'],
//            ['label' => 'Electric Saws', 'url' => '/shop/catalog'],
//            ['label' => 'Brush Cutters', 'url' => '/shop/catalog'],
//        ]);
//
//        // Add children for menu2
//        $solderingEquipment->children()->createMany([
//            ['label' => 'Soldering Station', 'url' => '/shop/catalog'],
//            ['label' => 'Soldering Dryers', 'url' => '/shop/catalog'],
//            ['label' => 'Gas Soldering Iron', 'url' => '/shop/catalog'],
//            ['label' => 'Electric Soldering Iron', 'url' => '/shop/catalog'],
//        ]);
    }

    public function run1()
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
