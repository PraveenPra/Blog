<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions on each seeding
        app()['cache']->forget('spatie.permission.cache');

        // Create admin role
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Define permissions
        $permissions = [
            'create posts', 'edit posts', 'delete posts','edit own posts', 'delete own posts',
            'create comments', 'edit comments','edit own comments','delete comments', 'delete own comments',
            'manage categories', 'manage tags', 'use admin features'
        ];

        $userPermissions = [
            //must be in the permissions array.
            'create posts','edit own posts', 'delete own posts', 'create comments', 'edit own comments',
            'delete own comments',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to admin role
        $adminRole->syncPermissions($permissions);


        // Assign specific permissions to the 'user' role
        $userRole->syncPermissions($userPermissions);
        
        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@a.com',
            'password' => Hash::make('00000000')
        ]);

        // Assign admin role to the admin user
        $admin->assignRole('admin');

        $this->command->info('Admin user created with email: admin@a.com');
    }
}
