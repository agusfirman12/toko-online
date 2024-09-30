<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' =>'create-User']);
        Permission::create(['name' =>'edit-User']);
        Permission::create(['name' =>'delete-User']);
        Permission::create(['name' =>'view-User']);

        Permission::create(['name' =>'create-Product']);
        Permission::create(['name' =>'edit-Product']);
        Permission::create(['name' =>'delete-Product']);
        Permission::create(['name' =>'view-Product']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'seller']);
        Role::create(['name' => 'user']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo([
            'create-User', 'edit-User', 'delete-User', 'view-User',
        ]);

        $roleSeller = Role::findByName('seller');
        $roleSeller->givePermissionTo([
            'create-Product', 'edit-Product', 'delete-Product', 'view-Product',
        ]);

        $roleUser = Role::findByName('user');
        $roleUser->givePermissionTo('view-Product');
    }
}
