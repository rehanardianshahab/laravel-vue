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
Route::get('/api/publishers', [PublisherController::class, 'api']);
Route::get('/api/publishers/trash', [PublisherController::class, 'apiTrash']);
Route::group(['prefix' => 'publishers'], function() {
    Route::get('/', [PublisherController::class, 'index'])->name('publisher.index');
    // Route::get('/create', [PublisherController::class, 'create'])->name('publisher.create');
    // Route::get('/restore', [PublisherController::class, 'restore']);
    Route::get('/restoreAll', [PublisherController::class, 'restoreAll']);
    Route::get('/trash', [PublisherController::class, 'trash'])->name('publisher.trash');
    // Route::get('/create', [PublisherController::class, 'store'])->name('publisher.store');
    // Route::post('/create', [PublisherController::class, 'store'])->name('publisher.store');
    Route::post('/', [PublisherController::class, 'store'])->name('publisher.store');
    // Route::get('/{publisher}/show', 'PublisherController@show')->name('publisher.show');
    // Route::get('/{publisher}/edit', 'PublisherController@edit')->name('publisher.edit');
    Route::post('/{publisher}/update', [PublisherController::class, 'update'])->name('publisher.update');
    // Route::put('/{publisher}/update', [PublisherController::class, 'update'])->name('publisher.update');
    Route::get('/restore', [PublisherController::class, 'restore']);
    Route::delete('/delete/{publisher}', [PublisherController::class, 'destroy'])->name('publisher.destroy');
    Route::get('/force-delete', [PublisherController::class, 'delete']);
    // Route::get('/delete/{publisher}', [PublisherController::class, 'destroy'])->name('publisher.destroy');
    Route::get('/force-delete', [PublisherController::class, 'delete']);
    Route::get('/force-deleteAll', [PublisherController::class, 'deleteAll']);
    Route::get('/restore-all', [PublisherController::class, 'storeAll'])->name('publisher.restore-all');
});

Route::group(['prefix' => 'home'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
});

// halaman books
Route::get('/api/books', [BookController::class, 'api'])->name('books.api');
Route::group(['prefix' => 'books'], function() {
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::post('/', [BookController::class, 'store'])->name('books.store');
    Route::post('/{book}/update', [BookController::class, 'update'])->name('books.update');
    Route::delete('/delete/{book}', [BookController::class, 'destroy'])->name('publisher.destroy');
});

// halaman catalogs
Route::get('/api/catalogs', [CatalogController::class, 'api']);
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
    Route::get('/delete-all', [App\Http\Controllers\CatalogController::class, 'deleteAll'])->name('catalogs.delete-all');
});

// halaman autors
Route::get('/api/authors', [AuthorController::class, 'api']);
Route::group(['prefix' => 'authors'], function() {
    Route::get('/force-delete', [AuthorController::class, 'delete']);
    Route::get('/trash', [AuthorController::class, 'trash'])->name('authors.trash');
    Route::get('/authors-edit', [App\Http\Controllers\AuthorController::class, 'edit']);
    Route::put('/{author}', [App\Http\Controllers\AuthorController::class, 'update']);
    Route::get('/', [App\Http\Controllers\AuthorController::class, 'index']);
    Route::get('/restore-all', [App\Http\Controllers\AuthorController::class, 'storeAll'])->name('author.restore-all');
    Route::get('/delete-all', [App\Http\Controllers\AuthorController::class, 'deleteAll'])->name('author.delete-all');
    Route::post('/', [App\Http\Controllers\AuthorController::class, 'store']);
    Route::get('/authors-create', [App\Http\Controllers\AuthorController::class, 'create']);
    Route::get('/author', [App\Http\Controllers\AuthorController::class, 'restore']);
    Route::delete('/{author}', [App\Http\Controllers\AuthorController::class, 'destroy']);
});

// member
Route::get('/api/members', [App\Http\Controllers\MemberController::class, 'api']);
Route::get('/api/members/trash', [App\Http\Controllers\MemberController::class, 'apiTrash']);
Route::group(['prefix' => 'members'], function() {
    Route::get('/', [App\Http\Controllers\MemberController::class, 'index'])->name('members.index');
    Route::post('/', [App\Http\Controllers\MemberController::class, 'store'])->name('members.store');
    Route::post('/{member}/update', [App\Http\Controllers\MemberController::class, 'update'])->name('members.update');
    Route::delete('/delete/{member}', [App\Http\Controllers\MemberController::class, 'destroy'])->name('publisher.destroy');
    Route::get('/trash', [App\Http\Controllers\MemberController::class, 'trash'])->name('publisher.trash');
    Route::get('/restore', [App\Http\Controllers\MemberController::class, 'restore']);
    Route::get('/restoreAll', [App\Http\Controllers\MemberController::class, 'restoreAll']);
    Route::get('/force-delete', [App\Http\Controllers\MemberController::class, 'delete']);
    Route::get('/force-deleteAll', [App\Http\Controllers\MemberController::class, 'deleteAll']);
});

// transactions
Route::get('/api/transactions', [App\Http\Controllers\TransactionController::class, 'api']);
Route::get('/api/detil', [App\Http\Controllers\TransactionDetailController::class, 'api']);
Route::group(['prefix' => 'transactions'], function() {
    Route::get('/', [App\Http\Controllers\TransactionController::class, 'index']);
    Route::get('/detil', [App\Http\Controllers\TransactionDetailController::class, 'index']);
    Route::get('/edit', [App\Http\Controllers\TransactionController::class, 'createAndEdit']);
    Route::get('/create', [App\Http\Controllers\TransactionController::class, 'createAndEdit']);
    Route::post('/push', [App\Http\Controllers\TransactionController::class, 'store']);
    Route::delete('/delete/{transaction}', [App\Http\Controllers\TransactionController::class, 'destroy']);
    Route::put('/update/{transaction}', [App\Http\Controllers\TransactionController::class, 'update']);
    Route::put('/kembalikan/{transactionDetail}', [App\Http\Controllers\TransactionDetailController::class, 'update']);
    Route::get('/apipinjaman', [App\Http\Controllers\TransactionController::class, 'bukupinjaman']);
});

// notif
Route::get('/notif/api', [App\Http\Controllers\HomeController::class, 'api']);

// role User
Route::group(['prefix' => 'role'], function() {
    Route::get('/test', [App\Http\Controllers\UserRoleController::class, 'index']);
});