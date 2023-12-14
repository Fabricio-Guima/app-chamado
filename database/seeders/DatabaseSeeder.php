<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(StatusSeeder::class);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);

        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
        ]);

        $manager = User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
        ]);

        // Atribuir role 'admin' ao usuário admin
        $adminRole = Role::where('name', 'admin')->first();
        $admin->assignRole($adminRole);

        $managerRole = Role::where('name', 'manager')->first();
        $manager->assignRole($managerRole);

        $userRole = Role::where('name', 'user')->first();
        $user->assignRole($userRole);



        // Dar todas as permissões para a role 'admin'
        $allPermissions = \Spatie\Permission\Models\Permission::all();
        $adminRole->syncPermissions($allPermissions);

        $adminAccessPermission = \Spatie\Permission\Models\Permission::where('name', 'admin.access')->first();
        $managerRole->syncPermissions($adminAccessPermission);
    }
}
