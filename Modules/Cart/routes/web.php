<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Modules\Cart\App\Http\Controllers\CartController;

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
});
