<?php

namespace Database\Seeders;

use App\Models\Backend\Master\Discount;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $read = Permission::create(['name' => 'read-discounts']);
        $add = Permission::create(['name' => 'add-discounts']);
        $update = Permission::create(['name' => 'update-discounts']);
        $delete = Permission::create(['name' => 'delete-discounts']);

        $role = Role::where('name', 'super-admin')->first();
        $role->givePermissionTo([
            $read,
            $add,
            $update,
            $delete
        ]);

        Discount::insert([
            [
                'name' => 'New Year',
                'description' => 'Discount New Year',
                'type' => 'percentage',
                'value' => 10,
                'status' => 'active',
                'expire_date' => '2024-12-12',
            ],
            [
                'name' => 'Discount Hari Ibu',
                'description' => 'Discount Hari Ibu',
                'type' => 'percentage',
                'value' => 25,
                'status' => 'active',
                'expire_date' => '2024-12-12',
            ]
        ]);
    }
}