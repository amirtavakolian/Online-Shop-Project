<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\ActiveEmailController;
use Modules\Auth\App\Http\Controllers\AuthController;
use Modules\Auth\App\Http\Controllers\RegisterController;

Route::group(['prefix' => '/auth'], function () {

    Route::get('/register', [RegisterController::class, 'registerView'])
        ->name('register.index')->middleware('guest');

    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/active-email/{user:email}', ActiveEmailController::class)
        ->name('email.active')->middleware(['auth', 'not-verified']);
});
