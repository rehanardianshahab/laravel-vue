<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserRoleController extends Controller
{
    public function roleUser()
    {
        // membuat role dan permision============================================
        // $role = Role::create(['name' => 'administrator']);
        // $permission = Permission::create(['name' => 'mengelola peminjaman']);
        // 
        // kode diatas akan membuat sebuat data role baru (administrator) di tabel
        // role. jika sudah terbuat silahkan di comment. dan membuat permission di
        //  tabel permission
        // ======================================================================
        // gunakan juga code dibawah ini ketika menjalan permission
        // 
        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);
        // ======================================================================

        // check user ===========================================================
        // $user = auth()->user(); // mengecek user yang sedang digunakan
        // $user = User::get(); // menampilkan semua user 
        $user = User::with('roles')->get(); // menampilkan semua user dengan roles yang dia miliki
        // $user = auth()->user()->get(); // menampilkan semua yang sedang login
        // $user = auth()->user()->with('roles')->get(); // menampilkan semua yang sedang login beserta role yan dimiliki
        // return $user;
        // ======================================================================

        // asign roles ==========================================================
        // untuk memberikan role ke sebuah user bisa menggunakan methos assignRole()
        // dengan cara : getuser()->assignRole('nama role). note : assignRole() hanya
        // bisa digunakan pada 1 user yang dipilih
        // 
        // ---------------------------------------------------------------------
        // ini cara asign role ke user yang sedang digunakan.
        // 
        // $user = auth()->user(); // mengecek user yang sedang digunakan
        // $user->assignRole('administrator'); // memberikan user yang ijankan mengikuti role administrator
        // ---------------------------------------------------------------------
        // ini cara asign ke user dengan role = 1 (hanya user pertama)
        // 
        // $user = User::select(*)->where('role', '=', 1)->first;
        // $user->assignRole('administrator');
        // ---------------------------------------------------------------------
        // jika kita memberikan roleAsign() kepada suatu user, maka akan disimpan datanya
        // di tabel model_has_roles
        // ======================================================================
        
        // menghapus roles ======================================================
        // untuk menghapus roles yang ada pada user bisa gunakan ewmoveRole()
        // kode di bawah ini akan menghapus role administrator pada user yang
        // sedang digunakan.
        // 
        // $user = auth()->user();
        // $user->removeRole('administrator');
        // =====================================================================

        // dokumrntasi =========================================================
        // 
        // https://spatie.be/docs/laravel-permission/v5/
        // 
        // =====================================================================
        return $user;
    }
}
