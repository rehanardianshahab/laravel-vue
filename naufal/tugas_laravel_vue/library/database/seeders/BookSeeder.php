<?php

namespace Database\Seeders;

use App\Models\Book;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
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
            $book = new Book;

            $book->isbn = $faker->randomNumber(9);
            $book->title = $faker->name;
            $book->year = rand(2005, 2022);

            $book->publisher_id = rand(1, 10);
            $book->author_id = rand(1, 20);
            $book->catalog_id = rand(1, 8);

            $book->qty = rand(5, 50);
            $book->price = rand(10000, 100000);

            $book->save();
        }
    }
}
