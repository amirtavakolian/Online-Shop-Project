<?php

use Illuminate\Support\Facades\Route;
use Modules\Attributes\App\Http\Controllers\AttributesController;

Route::group(['prefix' => '/panel'], function () {
    Route::resource('attributes', AttributesController::class)->except('show');
});
