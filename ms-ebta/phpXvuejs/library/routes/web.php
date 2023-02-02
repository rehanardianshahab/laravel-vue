<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublisherController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CatalogController;

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index']);
// // Route::get('/publishers', [App\Http\Controllers\PublisherController::class, 'index']);
// Route::get('/books', [App\Http\Controllers\BookController::class, 'index']);
// Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index']);
// Route::get('/members', [App\Http\Controllers\MemberController::class, 'index']);

// // crud new file
// Route::get('/catalogs-create', [App\Http\Controllers\CatalogController::class, 'create']);
// Route::post('/catalogs', [App\Http\Controllers\CatalogController::class, 'store']);
// // Route::get('/publishers-create', [App\Http\Controllers\PublisherController::class, 'create']);
// // Route::post('/publishers', [App\Http\Controllers\PublisherController::class, 'store']);
// // Route::get('/author', [App\Http\Controllers\AuthorController::class, 'create']);
// Route::post('/authors', [App\Http\Controllers\AuthorController::class, 'store']);
// // crud edit
// Route::get('/publishers-edit', [App\Http\Controllers\PublisherController::class, 'edit']);
// Route::put('/publishers/{publisher}', [App\Http\Controllers\PublisherController::class, 'update']);
// Route::get('/author-edit', [App\Http\Controllers\AuthorController::class, 'edit']);
// Route::put('/authors/{author}', [App\Http\Controllers\AuthorController::class, 'update']);
// // crud Delete
// Route::delete('/publishers/{publisher}', [App\Http\Controllers\PublisherController::class, 'destroy']);
// Route::delete('/author/{author}', [App\Http\Controllers\AuthorController::class, 'destroy']);
// // Route::delete('/restor-publisher/{publisher}', [App\Http\Controllers\PublisherController::class, 'balik']);
// Route::get('/publishers/{publisher}',[App\Http\Controllers\PublisherController::class, 'balik'])->name('publishers.restore');
// Route::get('/publishers/trash', [PublisherController::class, 'trash'])->name('publisher.trash');

// // publisher
Route::group(['prefix' => 'publishers'], function() {
    Route::get('/', [PublisherController::class, 'index'])->name('publisher.index');
    // Route::get('/create', [PublisherController::class, 'create'])->name('publisher.create');
    Route::get('/publish', [PublisherController::class, 'restore']);
    Route::get('/trash', [PublisherController::class, 'trash'])->name('publisher.trash');
    Route::get('/create', [PublisherController::class, 'store'])->name('publisher.store');
    // Route::get('/{publisher}/show', 'PublisherController@show')->name('publisher.show');
    // Route::get('/{publisher}/edit', 'PublisherController@edit')->name('publisher.edit');
    Route::put('/{publisher}/update', [PublisherController::class, 'update'])->name('publisher.update');
    Route::get('/rest/{publisher}', [PublisherController::class, 'restore']);
    Route::delete('/{publisher}/delete', [PublisherController::class, 'destroy'])->name('publisher.destroy');
    Route::get('/force-delete', [PublisherController::class, 'delete']);
    Route::get('/restore-all', [PublisherController::class, 'storeAll'])->name('publisher.restore-all');
});

Route::group(['prefix' => 'home'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
});
Route::group(['prefix' => 'books'], function() {
    Route::get('/', [BookController::class, 'index'])->name('books.index');
});
Route::group(['prefix' => 'catalogs'], function() {
    Route::get('/force-delete', [CatalogController::class, 'delete']);
    Route::get('/trash', [CatalogController::class, 'trash'])->name('catalogs.trash');
    Route::get('/catalogs-edit', [App\Http\Controllers\CatalogController::class, 'edit']);
    Route::put('/{catalog}', [App\Http\Controllers\CatalogController::class, 'update']);
    Route::get('/', [App\Http\Controllers\CatalogController::class, 'index']);
    Route::get('/catalogs-create', [App\Http\Controllers\CatalogController::class, 'create']);
    Route::post('/', [App\Http\Controllers\CatalogController::class, 'store']);
    Route::delete('/{catalog}', [App\Http\Controllers\CatalogController::class, 'destroy']);
    Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'restore']);
    Route::get('/restore-all', [App\Http\Controllers\CatalogController::class, 'storeAll'])->name('catalogs.restore-all');
});
Route::group(['prefix' => 'authors'], function() {
    Route::get('/force-delete', [AuthorController::class, 'delete']);
    Route::get('/trash', [AuthorController::class, 'trash'])->name('authors.trash');
    Route::get('/authors-edit', [App\Http\Controllers\AuthorController::class, 'edit']);
    Route::put('/{author}', [App\Http\Controllers\AuthorController::class, 'update']);
    Route::get('/', [App\Http\Controllers\AuthorController::class, 'index']);
    Route::get('/restore-all', [App\Http\Controllers\AuthorController::class, 'storeAll'])->name('author.restore-all');
    Route::post('/', [App\Http\Controllers\AuthorController::class, 'store']);
    Route::get('/authors-create', [App\Http\Controllers\AuthorController::class, 'create']);
    Route::get('/author', [App\Http\Controllers\AuthorController::class, 'restore']);
    Route::delete('/{author}', [App\Http\Controllers\AuthorController::class, 'destroy']);
});
Route::group(['prefix' => 'members'], function() {
    Route::get('/', [App\Http\Controllers\MemberController::class, 'index'])->name('members.index');
});