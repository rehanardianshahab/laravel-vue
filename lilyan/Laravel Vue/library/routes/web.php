<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
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
Route::get('/spatie', [App\Http\Controllers\HomeController::class, 'spatie']);
// Route::get('/books', [App\Http\Controllers\BookController::class, 'index']);
// Route::get('/members', [App\Http\Controllers\MemberController::class, 'index']);

//Catalog
// Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index']);
// Route::get('/catalogs/create', [App\Http\Controllers\CatalogController::class, 'create']);
// Route::post('/catalogs', [App\Http\Controllers\CatalogController::class, 'store']);
// Route::get('/catalogs/{catalog}/edit', [App\Http\Controllers\CatalogController::class, 'edit']);
// Route::put('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'update']);
// Route::delete('/catalogs/{catalog}', [App\Http\Controllers\CatalogController::class, 'destroy']);

// Author
// Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index']);
// Route::get('/authors/create', [App\Http\Controllers\AuthorController::class, 'create']);
// Route::post('/authors', [App\Http\Controllers\AuthorController::class, 'store']);
// Route::get('/authors/{author}/edit', [App\Http\Controllers\AuthorController::class, 'edit']);
// Route::put('/authors/{author}', [App\Http\Controllers\AuthorController::class, 'update']);
// Route::delete('/authors/{author}', [App\Http\Controllers\AuthorController::class, 'destroy']);

// Publisher
// Route::get('/publishers', [App\Http\Controllers\PublisherController::class, 'index']);
// Route::get('/publishers/create', [App\Http\Controllers\PublisherController::class, 'create']);
// Route::post('/publishers', [App\Http\Controllers\PublisherController::class, 'store']);
// Route::get('/publishers/{publisher}/edit', [App\Http\Controllers\PublisherController::class, 'edit']);
// Route::put('/publishers/{publisher}', [App\Http\Controllers\PublisherController::class, 'update']);
// Route::delete('/publishers/{publisher}', [App\Http\Controllers\PublisherController::class, 'destroy']);

// Transaction
Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index']);
Route::get('/transactions/create', [App\Http\Controllers\TransactionController::class, 'create']);
Route::post('/transactions', [App\Http\Controllers\TransactionController::class, 'store']);
Route::get('/transactions/{transaction}/edit', [App\Http\Controllers\TransactionController::class, 'edit']);
Route::put('/transactions/{transaction}', [App\Http\Controllers\TransactionController::class, 'update']);
Route::get('/transactions/{transaction}/show', [App\Http\Controllers\TransactionController::class, 'show']);
Route::delete('/transactions/{transaction}', [App\Http\Controllers\TransactionController::class, 'destroy']);




// API
Route::get('/api/authors', [App\Http\Controllers\AuthorController::class, 'api']);
Route::get('/api/publishers', [App\Http\Controllers\PublisherController::class, 'api']);
Route::get('/api/members', [App\Http\Controllers\MemberController::class, 'api']);
Route::get('/api/books', [App\Http\Controllers\BookController::class, 'api']);


Route::resource('publishers', PublisherController::class);
Route::resource('catalogs', CatalogController::class);
Route::resource('authors', AuthorController::class);
Route::resource('members', MemberController::class);
Route::resource('books', BookController::class);

















