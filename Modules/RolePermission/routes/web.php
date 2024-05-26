<?php

use Illuminate\Support\Facades\Route;
use Modules\RolePermission\App\Http\Controllers\PermissionController;

Route::group(['prefix' => '/panel'], function () {
    Route::resource('permissions', PermissionController::class)->except('show');
});
