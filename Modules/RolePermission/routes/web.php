<?php

use Illuminate\Support\Facades\Route;
use Modules\RolePermission\App\Http\Controllers\PermissionController;
use Modules\RolePermission\App\Http\Controllers\RoleController;

Route::group(['prefix' => '/panel'], function () {
    Route::resource('permissions', PermissionController::class)->except('show');
});

Route::group(['prefix' => '/panel'], function () {
    Route::resource('roles', RoleController::class)->except('show');
});
