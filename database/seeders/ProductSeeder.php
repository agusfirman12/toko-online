<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Makanan',
            'description' => Str::random(50),
            'price' => 25000,
            'is_ready' => 1,
            'weight' => 500,
        ]);
        DB::table('products')->insert([
            'category_id' => 2,
            'name' => 'Minuman',
            'description' => Str::random(50),
            'price' => 15000,
            'is_ready' => 1,
            'weight' => 500,
        ]);
        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Makanan1',
            'description' => Str::random(50),
            'price' => 200000,
            'is_ready' => 1,
            'weight' => 500,
        ]);
        DB::table('products')->insert([
            'category_id' => 2,
            'name' => 'Minuman2',
            'description' => Str::random(50),
            'price' => 5000,
            'is_ready' => 1,
            'weight' => 500,
        ]);
        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Makanan2',
            'description' => Str::random(50),
            'price' => 25000,
            'is_ready' => 1,
            'weight' => 500,
        ]);
    }
}
