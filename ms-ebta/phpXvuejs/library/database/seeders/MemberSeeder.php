<?php

namespace Database\Seeders;

use App\Models\Member;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
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
            $member = new Member;

            $member->name = $faker->name;
            $member->email = $faker->email;
            $member->phone_number = '08' . $faker->randomNumber(9); //random number maksimal 9
            $member->address = $faker->address;
            $member->gender = $faker->randomElement($array = array ('L', 'P'));

            $member->save();
        }
    }
}