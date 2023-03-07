<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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