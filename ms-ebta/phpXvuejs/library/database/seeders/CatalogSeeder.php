<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
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
            $kiatalog = new Catalog;

            $kiatalog->name = $faker->name;

            $kiatalog->save();
        }
    }
}
