<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/katalog', [App\Http\Controllers\CatalogController::class, 'index'])->name('home');
Route::get('/publisher', [App\Http\Controllers\PublisherController::class, 'index'])->name('home');
Route::get('/buku', [App\Http\Controllers\BookController::class, 'index'])->name('home');
