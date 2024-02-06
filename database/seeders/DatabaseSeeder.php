<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            AssignPermissionsToRoles::class,
            UserSeeder::class
        ]);

        BlogCategory::factory()->count(10)->create();

        Blog::factory()->count(10)->hasComments(rand(2,5))->create();
    }
}
