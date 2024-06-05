<?php

use Illuminate\Support\Facades\Route;
use Modules\Coworkers\App\Http\Controllers\DepartmentsController;

Route::group(['prefix' => '/panel'], function () {
    Route::resource('departments', DepartmentsController::class);
});
