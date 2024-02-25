<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $readUsers = Permission::create(['name' => 'read-users']);
        $addUsers = Permission::create(['name' => 'add-users']);
        $updateUsers = Permission::create(['name' => 'update-users']);
        $deleteUsers = Permission::create(['name' => 'delete-users']);
        $register = Permission::create(['name' => 'register-users']);

        $readRoles = Permission::create(['name' => 'read-roles']);
        $addRoles = Permission::create(['name' => 'add-roles']);
        $updateRoles = Permission::create(['name' => 'update-roles']);
        $deleteRoles = Permission::create(['name' => 'delete-roles']);

        $readPermissions = Permission::create(['name' => 'read-permissions']);
        $addPermissions = Permission::create(['name' => 'add-permissions']);
        $updatePermissions = Permission::create(['name' => 'update-permissions']);
        $deletePermissions = Permission::create(['name' => 'delete-permissions']);

        $readSuperadmin = Permission::create(['name' => 'read-super-admin']);

        $readAdmin = Permission::create(['name' => 'read-admin']);

        $readKasir = Permission::create(['name' => 'read-kasir']);

        // Role
        Role::create(['name' => 'super-admin'])->givePermissionTo(Permission::all());

        Role::create(['name' => 'admin'])->givePermissionTo([
            $readUsers,
            $addUsers,
            $updateUsers,
            $deleteUsers,
            $readRoles,
            $addRoles,
            $updateRoles,
            $deleteRoles,
            $readPermissions,
            $addPermissions,
            $updatePermissions,
            $deletePermissions,
            $readRoles,
            $addRoles,
            $updateRoles,
            $deleteRoles,
            $readKasir,
            $register
        ]);

        Role::create(['name' => 'kasir'])->givePermissionTo([
            $updateUsers,
        ]);
    }
}
