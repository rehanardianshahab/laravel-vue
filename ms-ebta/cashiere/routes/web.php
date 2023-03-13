<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/home');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/member/cetak-member', [App\Http\Controllers\MemberController::class, 'cetakMember'])->name('member.cetak_member')->middleware('auth');
Route::post('/product/cetak-barcode', [App\Http\Controllers\ProductController::class, 'cetakBarcode'])->name('product.cetak_barcode')->middleware('auth');