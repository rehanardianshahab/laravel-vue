<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // memanggil faker
        $faker = faker::create();
        // script looping
        for ($i=0; $i < 20; $i++) { 
            $buku = new Book;

            $buku->isbn = 'ISBN-' . $faker->randomNumber(3) . '-' . $faker->randomNumber(3) . '-' . $faker->randomNumber(3) . '-' . $faker->randomNumber(3) . '-' . $faker->randomNumber(1);
            $buku->title = $faker->name;
            $buku->year = rand(1990,2021);
            $buku->publisher_id = rand(1, 20);
            $buku->author_id = rand(1, 20);
            $buku->catalog_id = rand(1, 20);
            $buku->qty = rand(1, 40);
            $buku->price = rand(10000, 50000);

            $buku->save();
        }
    }
}
