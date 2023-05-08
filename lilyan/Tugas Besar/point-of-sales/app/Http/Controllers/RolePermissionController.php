<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function spatie()
    {
        // Reset cached roles and permissions = php artisan cache:forget spatie.permission.cache
        app()['cache']->forget('spatie.permission.cache');

        $dashboardPermission   = ['name' => 'lihat dashboard'];
        $categoryPermissions   = [ 'lihat kategori', 'tambah kategori', 'edit kategori', 'hapus kategori'];
        $productPermissions    = [ 'lihat produk', 'tambah produk', 'edit produk', 'hapus produk', 'cetak barcode'];
        $memberPermissions     = [ 'lihat member', 'tambah member', 'edit member', 'hapus member'];
        $expensePermissions    = [ 'lihat pengeluaran', 'tambah pengeluaran', 'edit pengeluaran', 'hapus pengeluaran'];
        $supplierPermissions   = [ 'lihat supplier', 'tambah supplier', 'edit supplier', 'hapus supplier'];
        $settingPermissions    = [ 'lihat pengaturan', 'tambah pengaturan', 'edit pengaturan'];
        $purchasePermissions   = [ 'lihat pembelian', 'tambah pembelian', 'detail pembelian', 'hapus pembelian'];
        $salePermissions       = [ 'lihat penjualan', 'tambah penjualan', 'detail penjualan', 'hapus penjualan', 'print penjualan'];

        // create permission
        foreach ($dashboardPermission as $key => $value) {
            Permission::create(['name' => $value]);
        }
        foreach ($categoryPermissions as $key => $value) {
            Permission::create(['name' => $value]);
        }
        foreach ($productPermissions as $key => $value) {
            Permission::create(['name' => $value]);
        }
        foreach ($memberPermissions as $key => $value) {
            Permission::create(['name' => $value]);
        }
        foreach ($expensePermissions as $key => $value) {
            Permission::create(['name' => $value]);
        }
        foreach ($supplierPermissions as $key => $value) {
            Permission::create(['name' => $value]);
        }
        foreach ($settingPermissions as $key => $value) {
            Permission::create(['name' => $value]);
        }
        foreach ($purchasePermissions as $key => $value) {
            Permission::create(['name' => $value]);
        }
        foreach ($salePermissions as $key => $value) {
            Permission::create(['name' => $value]);
        }

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $kasirRole = Role::create(['name' => 'kasir']);
        $kasirRole->givePermissionTo($salePermissions);

        $adminUser = User::where('name', 'Admin')->first();
        $adminUser->assignRole('admin');

        $kasirUser = User::where('name', 'Kasir')->first();
        $kasirUser->assignRole('kasir');
    }
}
