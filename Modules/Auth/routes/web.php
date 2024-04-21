<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\ActiveEmailController;
use Modules\Auth\App\Http\Controllers\ForgetPasswordController;
use Modules\Auth\App\Http\Controllers\LoginController;
use Modules\Auth\App\Http\Controllers\LoginViaLinkController;
use Modules\Auth\App\Http\Controllers\MagicLoginController;
use Modules\Auth\App\Http\Controllers\RegisterController;

Route::group(['prefix' => '/auth'], function () {

    Route::get('/register', [RegisterController::class, 'registerView'])
        ->name('register.index')->middleware('guest');

    Route::post('/register', [RegisterController::class, 'register'])->name('register')->middleware('guest');

    Route::get('/active-email', [ActiveEmailController::class, 'index'])
        ->name('email.active.index')->middleware('auth');
    Route::post('/active-email/{user:email}/send', [ActiveEmailController::class, 'sendVerificationEmail'])
        ->name('email.active.send')->middleware('auth');
    Route::get('/active-email/{user:email}/verify', [ActiveEmailController::class, 'verify'])
        ->name('email.active.verify')->middleware('auth');

    Route::get('/login', [LoginController::class, 'loginView'])->name('login.index')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

    Route::get('/unlock', [LoginController::class, 'unlockView'])->name('unlock.index');
    Route::post('/unlock', [LoginController::class, 'unlock'])->name('unlock');

    Route::get('/unlock/{user:email}', [LoginController::class, 'unlockEmail'])->name('unlock.email');

    Route::get('/forgot-password', [ForgetPasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password', [ForgetPasswordController::class, 'forgetPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'resetPasswordView'])->name('password.reset');
    Route::post('/reset-password', [ForgetPasswordController::class, 'resetPassword'])->name('password.update');

    Route::get('/link-login', [LoginViaLinkController::class, 'index'])->name('login.link.view');
    Route::post('/link-login/generate', [LoginViaLinkController::class, 'generateLink'])->name('login.link.generate');
    Route::get('/link-login/login', [LoginViaLinkController::class, 'login'])->name('login.link');

    Route::prefix('/magic/login')->middleware(['guest'])->group(function () {
        Route::get('/', [MagicLoginController::class, 'index'])->name('magic.link.index');
        Route::post('/generateToken', [MagicLoginController::class, 'sendMagicLoginLink'])->name('magic.link.generate.token');
        Route::get('/authenticate', [MagicLoginController::class, 'authenticate'])->name('login.link.authenticate');
    });

});
