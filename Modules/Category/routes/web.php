<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\App\Http\Controllers\CategoryController;

Route::group(['prefix' => '/panel'], function () {

    Route::resource('category', CategoryController::class)->except('show');
});
