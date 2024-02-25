<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $readCategories = Permission::create(['name' => 'read-products']);
        $addCategories = Permission::create(['name' => 'add-products']);
        $updateCategories = Permission::create(['name' => 'update-products']);
        $deleteCategories = Permission::create(['name' => 'delete-products']);

        $role = Role::where('name', 'super-admin')->first();
        $role->givePermissionTo([
            $readCategories,
            $addCategories,
            $updateCategories,
            $deleteCategories
        ]);

        \App\Models\Backend\Product::factory(100)->create();
    }
}