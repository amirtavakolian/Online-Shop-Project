<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\App\Http\Controllers\ProductController;
use Modules\Product\App\Http\Controllers\ProductImageController;

Route::group(['prefix' => '/panel/products'], function () {

    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/{category}/attributes', [ProductController::class, 'attributeCategory'])->name('product.category-attribute');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/{product}/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/{product}/category/edit', [ProductController::class, 'editCategory'])->name('product.category.edit');
    Route::put('/{product}/category/update', [ProductController::class, 'updateCategory'])->name('product.category.update');

    Route::get('/{product}/images/edit', [ProductImageController::class, 'editImage'])->name('product.images.edit');
    Route::put('/{product}/images/update', [ProductImageController::class, 'updateImage'])->name('product.images.update');

    Route::delete('/{product}/image/remove', [ProductImageController::class, 'deleteImage'])->name('product.images.delete');

});
