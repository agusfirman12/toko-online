<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'Makanan',
            'description' => 'Makanan Segar',
            'icon' => 'bi bi-bag-heart',
        ]);

        DB::table('categories')->insert([
            'name' => 'Minuman',
            'description' => 'Minuman Segar',
            'icon' => 'bi bi-cup-straw',]);
    }
}
