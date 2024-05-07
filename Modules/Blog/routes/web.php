<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\App\Http\Controllers\BlogController;
use Modules\Blog\App\Http\Controllers\CategoriesController;
use Modules\Blog\App\Http\Controllers\PostCalculateController;
use Modules\Blog\App\Http\Controllers\PostsController;
use Modules\Blog\App\Http\Controllers\TagsController;

Route::group(['prefix' => 'panel/blog', 'as' => 'blog.'], function () {
    Route::resource('tags', TagsController::class)->except(['create']);
    Route::resource('categories', CategoriesController::class)->except(['create']);
    Route::resource('/posts', PostsController::class);

    Route::post('/posts/calculate', PostCalculateController::class)->name('post.text.calculate');
});

Route::group(['prefix' => '/blog'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
});
