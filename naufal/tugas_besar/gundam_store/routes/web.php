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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index']);

// Member
Route::get('/members', [App\Http\Controllers\MemberController::class, 'index']);
Route::get('/api/members', [App\Http\Controllers\MemberController::class, 'api']);
Route::put('/members/{member}', [App\Http\Controllers\MemberController::class, 'update']);
Route::delete('/members/{member}', [App\Http\Controllers\MemberController::class, 'destroy']);

// Profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index']);
Route::get('/profile/{profile}/edit', [App\Http\Controllers\ProfileController::class, 'edit']);
Route::put('/profile/{profile}', [App\Http\Controllers\ProfileController::class, 'update']);
Route::delete('/profile/{profile}', [App\Http\Controllers\ProfileController::class, 'destroy']);

// Category
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/api/categories', [App\Http\Controllers\CategoryController::class, 'api']);
Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store']);
Route::put('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::delete('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'destroy']);

// Manufacturer
Route::get('/manufacturers', [App\Http\Controllers\ManufacturerController::class, 'index']);
Route::get('/api/manufacturers', [App\Http\Controllers\ManufacturerController::class, 'api']);
Route::post('/manufacturers', [App\Http\Controllers\ManufacturerController::class, 'store']);
Route::put('/manufacturers/{manufacturer}', [App\Http\Controllers\ManufacturerController::class, 'update']);
Route::delete('/manufacturers/{manufacturer}', [App\Http\Controllers\ManufacturerController::class, 'destroy']);

// Gundam Product
Route::get('/products', [App\Http\Controllers\GundamProductController::class, 'index']);
Route::get('/api/products', [App\Http\Controllers\GundamProductController::class, 'api']);
Route::get('/api/getcategory', [App\Http\Controllers\GundamProductController::class, 'getCategory']);
Route::get('/api/getmanufacturer', [App\Http\Controllers\GundamProductController::class, 'getManufacturer']);
Route::post('/products', [App\Http\Controllers\GundamProductController::class, 'store']);
Route::put('/products/{products}', [App\Http\Controllers\GundamProductController::class, 'update']);
Route::delete('/products/{products}', [App\Http\Controllers\GundamProductController::class, 'destroy']);

// Product Transactions
Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index']);
Route::get('/api/transactions', [App\Http\Controllers\TransactionController::class, 'api']);
Route::get('/api/createtrans', [App\Http\Controllers\TransactionController::class, 'dataCreate']);
Route::get('/api/prices', [App\Http\Controllers\TransactionController::class, 'dataPrice']);
Route::get('/transactions/create', [App\Http\Controllers\TransactionController::class, 'create']);
Route::post('/transactions', [App\Http\Controllers\TransactionController::class, 'store']);
Route::get('/transactions/{transactions}/edit', [App\Http\Controllers\TransactionController::class, 'edit']);
Route::put('/transactions/{transactions}', [App\Http\Controllers\TransactionController::class, 'update']);
Route::delete('/transactions/{transactions}', [App\Http\Controllers\TransactionController::class, 'delete']);