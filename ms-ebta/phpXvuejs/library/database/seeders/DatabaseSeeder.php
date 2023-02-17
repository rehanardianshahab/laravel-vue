<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// membuat role dan permision============================================
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
// ======================================================================

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
                
        // membuat role dan permision============================================
            $role = Role::create(['name' => 'administrator']);
            $permission = Permission::create(['name' => 'mengelola peminjaman']);
        // 
        // kode diatas akan membuat sebuat data role baru (administrator) di tabel
        // role. jika sudah terbuat silahkan di comment. dan membuat permission di
        //  tabel permission
        // ======================================================================

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
