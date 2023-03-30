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
        // $permission = Permission::create(['name' => 'access section']);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        // $roleMem = Role::create(['name' => 'member']);
        // $permissionMem = Permission::create(['name' => 'member note']);

        // $roleMem->givePermissionTo($permissionMem);
        // $permissionMem->assignRole($roleMem);

        // $user = User::where('is_admin', 1)->first();
        // $user->assignRole('admin');
        // return $user;

        // $member = User::where('is_admin', 0)->first();
        // $member->assignRole('member');
        // return $member;

        // $user = User::with('roles')->get();
        // return $user;

        // $user = User::where('is_admin', 0)->first();
        // $user->removeRole('admin');
    }
} 
