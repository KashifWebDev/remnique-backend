<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = [
            //For Admin
            ['id' => 1, 'name' => 'create-users'],
            ['id' => 2, 'name' => 'delete-users'],
            ['id' => 3, 'name' => 'create-post'],

            // For User/Writer
            ['id' => 4, 'name' => 'edit-post'],
            ['id' => 5, 'name' => 'delete-post'],
        ];

        foreach ($permissions as $permission){
            Permission::create([
                'id' => $permission['id'],
                'name' => $permission['name']
            ]);
        }
    }
}
