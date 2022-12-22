<?php

namespace Database\Seeders;

use App\Models\Author;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
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
            $author = new Author;

            $author->name = $faker->name;
            $author->email = $faker->email;
            $author->phone_number = '08' . $faker->randomNumber(9); //random number maksimal 9
            $author->address = $faker->address;

            $author->save();
        }
    }
}