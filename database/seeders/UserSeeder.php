<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $seller = User::create([
            'name' => 'Seller',
            'email' => 'seller@mail.com',
            'password' => bcrypt('password'),
        ]);
        $seller->assignRole('seller');
    }
}
