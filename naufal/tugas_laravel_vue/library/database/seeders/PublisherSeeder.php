<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Faker\Factory as Faker;
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
        $faker = Faker::create();

        for ($i=0; $i<10; $i++) {
            $publisher = new Publisher;

            $publisher->publisher_name = $faker->name;
            $publisher->email = $faker->email;
            $publisher->phone_number = '082'.$faker->randomNumber(8);
            $publisher->address = $faker->address;

            $publisher->save();
        }
    }
}
