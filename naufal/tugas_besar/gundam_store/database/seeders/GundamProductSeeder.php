<?php

namespace Database\Seeders;

use App\Models\GundamProduct;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GundamProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i<25; $i++) {
            $gundamProduct = new GundamProduct;

            $gundamProduct->product_name = $faker->name;
            $gundamProduct->price = rand(100000, 5000000);
            $gundamProduct->stock_qty = rand(1, 50);
            $gundamProduct->category_id = rand(1, 20);
            $gundamProduct->manufacturer_id = rand(1, 10);

            $gundamProduct->save();
        }
    }
}
