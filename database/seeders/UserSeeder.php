<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mark Otto
        User::create([
            'name'       => 'Mark Otto',
            'email'      => 'superadmin@girex.com',
            'password'   => Hash::make('superadmin123')
        ])->assignRole('super-admin');

        // John Doe
        User::create([
            'name'       => 'John Doe',
            'email'      => 'admin@girex.com',
            'password'   => Hash::make('admin123')
        ])->assignRole('admin');

        // Jacob Thornton
        User::create([
            'name'       => 'Jacob Thornton',
            'email'      => 'Kasir@girex.com',
            'password'   => Hash::make('kasir123')
        ])->assignRole('kasir');
    }
}
