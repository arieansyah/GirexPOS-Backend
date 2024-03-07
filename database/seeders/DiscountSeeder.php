<?php

namespace Database\Seeders;

use App\Models\Backend\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
                'value' => 10,
                'status' => 'active',
                'expire_date' => '2024-12-12',
            ]
        ]);
    }
}