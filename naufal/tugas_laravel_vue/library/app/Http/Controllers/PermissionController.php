<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function spatie() {
        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'transaction index']);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        $user = User::where('id', 1)->first();
        $user->assignRole('admin');
        return $user;

        // $user = User::with('roles')->get();
        // return $user;

        // $user = User::where('id', 2)->first();
        // $user->removeRole('admin');
    }
}
