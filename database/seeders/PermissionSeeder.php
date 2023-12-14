<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'admin.access'], ['guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'user.view'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'user.show'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'user.create'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'user.edit'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'user.delete'], ['guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'category.view'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'category.show'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'category.create'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'category.edit'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'category.delete'], ['guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'status.view'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'status.show'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'status.create'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'status.edit'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'status.delete'], ['guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'role.view'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'role.show'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'role.create'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'role.edit'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'role.delete'], ['guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'permission.view'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'permission.show'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'permission.create'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'permission.edit'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'permission.delete'], ['guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'ticket.view'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ticket.show'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ticket.create'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ticket.edit'], ['guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ticket.delete'], ['guard_name' => 'web']);
    }
}
