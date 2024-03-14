<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $read = Permission::create(['name' => 'read-categories']);
        $add = Permission::create(['name' => 'add-categories']);
        $update = Permission::create(['name' => 'update-categories']);
        $delete = Permission::create(['name' => 'delete-categories']);

        $role = Role::where('name', 'super-admin')->first();
        $role->givePermissionTo([
            $read,
            $add,
            $update,
            $delete
        ]);

        \App\Models\Backend\Master\Category::factory(10)->create();
    }
}