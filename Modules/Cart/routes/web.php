<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\App\Http\Controllers\CartController;

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/items', [CartController::class, 'getCartItems'])->name('cart.items');
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
});
