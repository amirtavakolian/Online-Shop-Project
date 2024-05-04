<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\App\Http\Controllers\CategoriesController;
use Modules\Blog\App\Http\Controllers\PostCalculateController;
use Modules\Blog\App\Http\Controllers\PostsController;
use Modules\Blog\App\Http\Controllers\TagsController;

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::resource('tags', TagsController::class)->except(['create']);
    Route::resource('categories', CategoriesController::class)->except(['create']);
    Route::resource('/posts', PostsController::class);

    Route::post('/posts/calculate', PostCalculateController::class)->name('post.text.calculate');
});
