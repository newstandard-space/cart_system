<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product');
    Route::get('/getProductDetailInfo/{id}', [ProductController::class, 'getProductDetailInfo']);
    Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');
});

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::put('/cart/addCart', [CartController::class, 'addCart']);
    Route::get('/cart/getCartInfo', [CartController::class, 'getCartInfo']);
    Route::delete('/cart/deleteCartItem', [CartController::class, 'deleteCartItem']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';