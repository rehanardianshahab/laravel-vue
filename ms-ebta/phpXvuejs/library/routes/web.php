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
Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index']);
Route::get('/publishers', [App\Http\Controllers\PublisherController::class, 'index']);
Route::get('/books', [App\Http\Controllers\BookController::class, 'index']);
Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index']);
Route::get('/members', [App\Http\Controllers\MemberController::class, 'index']);

// crud new file
Route::get('/catalogs-create', [App\Http\Controllers\CatalogController::class, 'create']);
Route::post('/catalogs', [App\Http\Controllers\CatalogController::class, 'store']);
Route::get('/publishers-create', [App\Http\Controllers\PublisherController::class, 'create']);
Route::post('/publishers', [App\Http\Controllers\PublisherController::class, 'store']);
// crud edit
Route::get('/catalogs-edit', [App\Http\Controllers\CatalogController::class, 'edit']);
Route::put('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'update']);
Route::get('/publishers-edit', [App\Http\Controllers\PublisherController::class, 'edit']);
Route::put('/publishers/{publisher}', [App\Http\Controllers\PublisherController::class, 'update']);
// crud Delete
Route::delete('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'destroy']);



