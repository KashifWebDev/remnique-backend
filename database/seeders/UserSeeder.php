<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => fake()->name(),
            'email' => 'admin@kashifali.me',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::factory(10)->create();
        User::find(1)->assignRole(Role::find(1));

        $users = User::where('id', '!=', 1)->get();
        foreach($users as $user){
            $user->assignRole(Role::where('id', '!=', 1)->get()->random()->id);
        }

    }
}
