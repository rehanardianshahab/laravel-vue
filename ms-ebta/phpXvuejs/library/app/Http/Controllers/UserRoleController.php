<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function roleUser(Type $var = null)
    {
        // $role = Role::create(['name' => 'administrator']);
        // $permission = Permission::created(['name' => 'administrasi peminjaman']);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        // $user = auth()->user();
        // $user->assignRole('administrator');
        // return $user;

        // $user = User::with('roles')->get();
        // return $user;

        // $user = auth()->user();
        // $user->removeRole('administrator');
    }
}
