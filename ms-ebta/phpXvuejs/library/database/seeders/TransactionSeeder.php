<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
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
            $trans = new Transaction;

            $trans->member_id = rand(1, 20);
            // $trans->date_start = $faker->dateTime();
            // $trans->date_end = $faker->dateTime();
            $trans->date_start = gmdate("Y-m-d", strtotime(date('Y-m-d')) + rand(1, 60)*86400);
            // $buku->status = rand(true, false);
            $trans->date_end = gmdate("Y-m-d", strtotime($trans->date_start) + rand(1, 70)*86400);


            $trans->save();
        }
    }
}