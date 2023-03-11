<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
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
            $manufacturer = new Manufacturer;

            $manufacturer->manufacture_company = $faker->name;
            $manufacturer->country = $faker->name;
            $manufacturer->established = $faker->date;

            $manufacturer->save();
        }

    }
}
