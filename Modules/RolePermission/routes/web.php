<?php

use Illuminate\Support\Facades\Route;
use Modules\RolePermission\App\Http\Controllers\PermissionController;
use Modules\RolePermission\App\Http\Controllers\RoleController;
use Modules\RolePermission\App\Http\Controllers\UserRoleController;

Route::group(['prefix' => '/panel', 'middleware' => 'auth'], function () {
    Route::resource('permissions', PermissionController::class)->except('show');
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('user-roles', UserRoleController::class)->except('show');
});
