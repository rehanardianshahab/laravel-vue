<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TransactionController;

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

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'dashboard']);
// Route::get('/books', [App\Http\Controllers\BookController::class, 'index']);
// Route::get('/members', [App\Http\Controllers\MemberController::class, 'index']);

// CRUD Catalog
// Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index']);
// Route::get('/catalogs/create', [App\Http\Controllers\CatalogController::class, 'create']);
// Route::post('/catalogs', [App\Http\Controllers\CatalogController::class, 'store']);
// Route::get('/catalogs/{catalog}/edit', [App\Http\Controllers\CatalogController::class, 'edit']);
// Route::put('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'update']);
// Route::delete('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'destroy']);

// CRUD Publisher
// Route::get('/publishers', [App\Http\Controllers\PublisherController::class, 'index']);
// Route::get('/publishers/create', [App\Http\Controllers\PublisherController::class, 'create']);
// Route::post('/publishers', [App\Http\Controllers\PublisherController::class, 'store']);
// Route::get('/publishers/{publisher}/edit', [App\Http\Controllers\PublisherController::class, 'edit']);
// Route::put('/publishers/{publisher}', [App\Http\Controllers\PublisherController::class, 'update']);
// Route::delete('/publishers/{publisher}', [App\Http\Controllers\PublisherController::class, 'destroy']);

// CRUD Author
// Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index']);

// Route Resource
Route::resource('/catalogs', CatalogController::class);
Route::resource('/publishers', PublisherController::class);
Route::resource('/authors', AuthorController::class);
Route::resource('/members', MemberController::class);
Route::resource('/books', BookController::class);
Route::resource('/transactions', TransactionController::class);

// Route API
Route::get('/api/authors', [AuthorController::class, 'api']);
Route::get('/api/publishers', [PublisherController::class, 'api']);
Route::get('/api/members', [MemberController::class, 'api']);
Route::get('/api/books', [BookController::class, 'api']);
Route::get('/api/transactions', [TransactionController::class, 'api']);