<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\ActiveEmailController;
use Modules\Auth\App\Http\Controllers\ForgetPasswordController;
use Modules\Auth\App\Http\Controllers\LoginController;
use Modules\Auth\App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

Route::group(['prefix' => '/auth'], function () {

    Route::get('/register', [RegisterController::class, 'registerView'])
        ->name('register.index')->middleware('guest');

    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/active-email/{user:email}', ActiveEmailController::class)
        ->name('email.active')->middleware('auth');

    Route::get('/login', [LoginController::class, 'loginView'])->name('login.index')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

    Route::get('/unlock', [LoginController::class, 'unlockView'])->name('unlock.index');
    Route::post('/unlock', [LoginController::class, 'unlock'])->name('unlock');

    Route::get('/unlock/{user:email}', [LoginController::class, 'unlockEmail'])->name('unlock.email');

    Route::get('/forgot-password', [ForgetPasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password', [ForgetPasswordController::class, 'forgetPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'resetPasswordView'])->name('password.reset');
    Route::post('/reset-password', [ForgetPasswordController::class, 'resetPassword'])->name('password.update');
});
