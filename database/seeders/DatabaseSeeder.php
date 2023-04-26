<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        
        $this->call([
            RecipeSeeder::class,
            RolesPermissionsSeeder::class,
        ]);
        
        foreach (\App\Models\User::all() as $user) {
            $user->assignRole('user');
        }
        
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('testtt'),
        ])->assignRole('admin');
    }
}
