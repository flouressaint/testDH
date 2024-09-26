<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Reviews;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $product_ids = Products::pluck('id', 'id')->toArray();

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            Reviews::create([
                'customer' => $faker->name,
                'product_id' => array_rand($product_ids, 1),
                'review' => $faker->paragraph(3),
            ]);
        }
    }
}
