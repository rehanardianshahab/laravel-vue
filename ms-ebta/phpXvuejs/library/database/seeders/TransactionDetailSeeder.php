<?php

namespace Database\Seeders;

use App\Models\TransactionDetail;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionDetailSeeder extends Seeder
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
        for ($i=0; $i < 30; $i++) { 
            $trans = new TransactionDetail;

            $trans->transaction_id = rand(1, 20);
            $trans->book_id = rand(1, 20);
            $trans->qty_pinjam = 1;
            // $date_start = $faker->dateTime();
            // $trans->date_end = $faker->dateTime();
            $date_start = gmdate("Y-m-d", strtotime(date('Y-m-d')) + rand(1, 60)*86400);
            $trans->status = rand(true, false);
            if ($trans->status == false) {
                // $trans->date_end = '-';
            } else {
                $trans->tgl_kembali = gmdate("Y-m-d", strtotime($date_start) + rand(0, 70)*86400);
            }


            $trans->save();
        }
    }
}
