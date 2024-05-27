<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\RolePermission\App\Http\Controllers\PermissionController;
use Modules\RolePermission\App\Http\Controllers\RoleController;
use Modules\RolePermission\App\Http\Controllers\UserRoleController;

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => '/panel'], function () {
        Route::resource('permissions', PermissionController::class)->except('show');
    });

    Route::group(['prefix' => '/panel'], function () {
        Route::resource('roles', RoleController::class)->except('show');
    });

    Route::group(['prefix' => '/panel'], function () {
        Route::resource('user-roles', UserRoleController::class)->except('show');
    });
});
