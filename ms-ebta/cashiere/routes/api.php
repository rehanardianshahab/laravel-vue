<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PurchasingDetailController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SelesaiController;
use App\Http\Controllers\SalesDetailController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/category/{id?}', [CategoryController::class, 'show']);
Route::put('/category/{category?}', [CategoryController::class, 'update']);
Route::delete('/category/{id?}', [CategoryController::class, 'destroy']);

Route::group(['prefix' => 'product'], function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{id?}', [ProductController::class, 'show']);
    Route::put('/{id?}', [ProductController::class, 'update']);
    Route::delete('/{id?}', [ProductController::class, 'destroy']);
    Route::post('/delete-selected', [ProductController::class, 'deleteSelected'])->name('product.deleteSelected');
});

Route::group(['prefix' => 'member'], function() {
    Route::get('/', [MemberController::class, 'index']);
    Route::post('/', [MemberController::class, 'store']);
    Route::get('/{id?}', [MemberController::class, 'show']);
    Route::put('/{id?}', [MemberController::class, 'update']);
    Route::delete('/{member?}', [MemberController::class, 'destroy']);
    Route::post('/delete-selected', [MemberController::class, 'deleteSelected'])->name('product.deleteSelected');
});

Route::group(['prefix' => 'supplier'], function() {
    Route::get('/', [SupplierController::class, 'index']);
    Route::post('/', [SupplierController::class, 'store']);
    Route::get('/{id?}', [SupplierController::class, 'show']);
    Route::put('/{id?}', [SupplierController::class, 'update']);
    Route::delete('/{supplier?}', [SupplierController::class, 'destroy']);
});

Route::group(['prefix' => 'expense'], function() {
    Route::get('/', [ExpenseController::class, 'index']);
    Route::post('/', [ExpenseController::class, 'store']);
    Route::get('/{id?}', [ExpenseController::class, 'show']);
    Route::put('/{id?}', [ExpenseController::class, 'update']);
    Route::delete('/{expense?}', [ExpenseController::class, 'destroy']);
});

Route::group(['prefix' => 'purchasing'], function() {
    Route::get('/{id}/create', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::get('/data', [PurchaseController::class, 'data'])->name('purchase.data');
    Route::get('/dataSupplier', [PurchaseController::class, 'dataSupplier']);
    Route::delete('/{purchase}', [PurchaseController::class, 'destroy']);
    Route::resource('/', PurchaseController::class)->except('create');
    Route::put('/{id}/diskon', [PurchaseController::class, 'diskonUpdate']);
    Route::put('/{id}/save', [PurchaseController::class, 'save']);
});

Route::group(['prefix' => 'purchasing-detail'], function() {
    Route::get('/{id}/create', [PurchasingDetailController::class, 'create'])->name('purchase.create');
    Route::get('/{id}/data', [PurchasingDetailController::class, 'data'])->name('purchase.data');
    Route::delete('/{id}', [PurchasingDetailController::class, 'destroy']);
    Route::get('/dataProduct', [PurchasingDetailController::class, 'dataProduct']);
    Route::get('/{purchase}/dataPurchase', [PurchasingDetailController::class, 'dataPurchase']);
    Route::post('/{product}/{id}/store', [PurchasingDetailController::class, 'store']);
    Route::post('/{id}/update', [PurchasingDetailController::class, 'update']);
    Route::resource('/', PurchasingDetailController::class)->except('create');
});

Route::group(['prefix' => 'selling'], function() {
    Route::get('/', [SaleController::class, 'index']);
    Route::get('/datatable', [SaleController::class, 'datatable']);
    Route::get('/nota-kecil/{id}', [SelesaiController::class, 'notaKecil']);
    Route::post('/new', [SaleController::class, 'create']);
    Route::delete('/{sale}', [SaleController::class, 'destroy']);
    Route::put('/{id}/save', [SaleController::class, 'update']);
});

Route::group(['prefix' => 'selling-detail'], function() {
    Route::get('/dataProduct', [SalesDetailController::class, 'dataProduct']);
    Route::get('/{sale}/show', [SalesDetailController::class, 'show']);
    Route::get('/dataMember', [SalesDetailController::class, 'dataMember']);
    Route::post('/memberUpdate', [SalesDetailController::class, 'memberUpdate']);
    Route::post('/store', [SalesDetailController::class, 'store']);
    Route::get('/{id}', [SalesDetailController::class, 'data']);
    Route::delete('/{salesDetail}', [SalesDetailController::class, 'destroy']);
    Route::put('/{id}', [SalesDetailController::class, 'update']);
});

Route::group(['prefix' => 'selesai'], function() {
    Route::get('/', [PurchasingDetailController::class, 'selesaiData']);
    // Route::resource('/', PurchasingDetailController::class)->except('create');
    Route::get('/settingget', [selesaiController::class, 'settingget']);
    Route::put('/discount', [selesaiController::class, 'discount']);
});