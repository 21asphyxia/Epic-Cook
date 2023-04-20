<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $chef =  Role::create(['name' => 'chef']);
        $user = Role::create(['name' => 'user']);

        // Recipes
        Permission::create(['name' => 'create recipes']);
        Permission::create(['name' => 'update all recipes']);
        Permission::create(['name' => 'update own recipes']);
        Permission::create(['name' => 'delete all recipes']);
        Permission::create(['name' => 'delete own recipes']);

        // Ingredients
        Permission::create(['name' => 'update all ingredients']);
        Permission::create(['name' => 'delete all ingredients']);

        // Instructions
        Permission::create(['name' => 'update all instructions']);
        Permission::create(['name' => 'delete all instructions']);

        // Comments
        Permission::create(['name' => 'create comments']);
        Permission::create(['name' => 'update own comments']);
        Permission::create(['name' => 'delete all comments']);
        Permission::create(['name' => 'delete own comments']);

        // Ratings
        Permission::create(['name' => 'create ratings']);
        Permission::create(['name' => 'update own ratings']);
        Permission::create(['name' => 'delete all ratings']);

        // Users
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Roles
        Permission::create(['name' => 'assign role']);
        Permission::create(['name' => 'revoke role']);

        $admin->givePermissionTo(Permission::all());
        $chef->givePermissionTo([
            'create recipes',
            'update own recipes',
            'delete own recipes',
            'create comments',
            'update own comments',
            'delete own comments',
        ]);
        $user->givePermissionTo([
            'create recipes',
            'update own recipes',
            'delete own recipes',
            'create comments',
            'update own comments',
            'delete own comments',
        ]);

        
    }
}
