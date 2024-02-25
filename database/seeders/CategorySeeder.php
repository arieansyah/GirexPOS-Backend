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
        $readCategories = Permission::create(['name' => 'read-categories']);
        $addCategories = Permission::create(['name' => 'add-categories']);
        $updateCategories = Permission::create(['name' => 'update-categories']);
        $deleteCategories = Permission::create(['name' => 'delete-categories']);

        $role = Role::where('name', 'super-admin')->first();
        $role->givePermissionTo([
            $readCategories,
            $addCategories,
            $updateCategories,
            $deleteCategories
        ]);

        \App\Models\Backend\Master\Category::factory(10)->create();
    }
}
