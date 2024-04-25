<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\App\Http\Controllers\CategoriesController;
use Modules\Blog\App\Http\Controllers\TagsController;

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::resource('tags', TagsController::class)->except(['create']);
    Route::resource('categories', CategoriesController::class)->except(['create']);
});
