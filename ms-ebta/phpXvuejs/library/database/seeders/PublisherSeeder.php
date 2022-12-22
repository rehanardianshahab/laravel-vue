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
            $publiser = new Publisher;

            $publiser->name = $faker->name;
            $publiser->email = $faker->email;
            $publiser->phone_number = '08' . $faker->randomNumber(9); //random number maksimal 9
            $publiser->address = $faker->address;

            $publiser->save();
        }
    }
}
