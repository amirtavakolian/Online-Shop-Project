<?php

use Illuminate\Support\Facades\Route;
use Modules\Tags\App\Http\Controllers\TagsController;

Route::group(['prefix' => '/panel'], function () {
    Route::resource('tags', TagsController::class)->except('show');
});
