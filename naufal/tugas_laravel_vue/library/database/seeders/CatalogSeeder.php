<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Faker\Factory as Faker;
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
        $faker = Faker::create();

        for ($i=0; $i<8; $i++) {
            $catalog = new Catalog;
    
            $catalog->catalog_name = $faker->name;
    
            $catalog->save();
        }
    }
}
