<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            Products::create([
                'name' => $faker->sentence(3),
                'description' => $faker->paragraph(3),
                'price' => $faker->randomFloat(2, 0, 10000),
                'in_stock' => $faker->boolean,
                'weight' => $faker->randomFloat(2, 0, 1000),
            ]);
        }
    }
}
