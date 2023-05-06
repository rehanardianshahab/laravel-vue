<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/spatie', [App\Http\Controllers\RolePermissionController::class, 'spatie']);

Route::resource('categories', CategoryController::class);

Route::resource('products', ProductController::class);
Route::post('/products/delete-selected', [App\Http\Controllers\ProductController::class, 'deleteSelected'])->name('products.delete_selected');
Route::post('/products/cetak-barcode', [App\Http\Controllers\ProductController::class, 'cetakBarcode'])->name('products.cetak_barcode');

Route::resource('members', MemberController::class);
Route::post('/members/cetak-member', [App\Http\Controllers\MemberController::class, 'cetakMember'])->name('members.cetak_member');

Route::resource('suppliers', SupplierController::class);

Route::resource('expenses', ExpenseController::class);

Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::get('/purchases/{id}/create', [PurchaseController::class, 'create'])->name('purchases.create');
Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
Route::delete('/purchases/{purchases}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
Route::get('/purchases/{id}', [PurchaseController::class, 'show'])->name('purchases.show');

Route::get('/purchase_details', [PurchaseDetailController::class, 'index'])->name('purchase_details.index');
Route::post('/purchase_details', [PurchaseDetailController::class, 'store'])->name('purchase_details.store');
Route::delete('/purchase_details/{purchaseDetail}', [PurchaseDetailController::class, 'destroy'])->name('purchase_details.destroy');
Route::put('/purchase_details/{id}', [PurchaseDetailController::class, 'update']);
Route::get('/purchase_details/loadform/{discount}/{total}', [PurchaseDetailController::class, 'loadForm'])->name('purchase_details.load_form');

Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
Route::get('/sales/{id}', [SaleController::class, 'show'])->name('sales.show');
Route::get('/transactions/new', [SaleController::class, 'create'])->name('transactions.new');
Route::post('/transactions/store', [SaleController::class, 'store'])->name('transactions.store');
Route::get('/transactions/nota-kecil', [SaleController::class, 'notaKecil'])->name('transactions.nota_kecil');

Route::resource('/sale_details', SaleDetailController::class);
Route::get('/sale_details/loadform/{discount}/{total}/{cash}', [SaleDetailController::class, 'loadForm'])->name('sale_details.load_form');

// Route::resource('settings', SettingController::class);
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::get('/settings/create', [SettingController::class, 'create'])->name('settings.create');
Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
Route::get('/settings/{id}/edit', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('/settings/{id}/update', [SettingController::class, 'update'])->name('settings.update');
Route::get('/settings/{id}', [SettingController::class, 'show'])->name('settings.show');

Route::get('/api/categories', [App\Http\Controllers\CategoryController::class, 'api']);
Route::get('/api/products', [App\Http\Controllers\ProductController::class, 'api']);
Route::get('/api/members', [App\Http\Controllers\MemberController::class, 'api']);
Route::get('/api/suppliers', [App\Http\Controllers\SupplierController::class, 'api']);
Route::get('/api/expenses', [App\Http\Controllers\ExpenseController::class, 'api']);
Route::get('/api/purchases', [App\Http\Controllers\PurchaseController::class, 'api']);
Route::get('/api/purchase_details', [App\Http\Controllers\PurchaseDetailController::class, 'api'])->name('api.purchase_details');
Route::get('api/purchase_details/{purchase_id}', [\App\Http\Controllers\PurchaseDetailController::class, 'api'])->name('api.purchase_details');
Route::get('/api/sales', [App\Http\Controllers\SaleController::class, 'api']);
Route::get('/api/sale_details', [App\Http\Controllers\SaleDetailController::class, 'api']);
Route::get('api/sale_details/{sale_id}', [\App\Http\Controllers\SaleDetailController::class, 'api'])->name('api.sale_details');









