<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\App\Http\Controllers\ProductController;

Route::group(['prefix' => '/panel/products'], function () {

    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/{category}/attributes', [ProductController::class, 'attributeCategory'])->name('product.category-attribute');
});
