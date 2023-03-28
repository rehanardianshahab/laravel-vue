<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting')->insert([
            'id' => 1,
            'name_store' => 'Cashere',
            'address' => 'Jl. Jalan Santai, No.1, Finish',
            'phone' => '0881234567910',
            'nota_type' => 1, // little
            'path_logo' => '/img/logo.png',
            'path_member_card' => '/img/member.png'
        ]);
    }
}
