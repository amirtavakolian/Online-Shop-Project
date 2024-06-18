<?php

use Illuminate\Support\Facades\Route;
use Modules\Coworkers\App\Http\Controllers\CoworkerAuthenticationController;
use Modules\Coworkers\App\Http\Controllers\CoworkersController;
use Modules\Coworkers\App\Http\Controllers\DepartmentsController;
use Modules\Coworkers\App\Http\Controllers\TicketController;

Route::group(['prefix' => '/panel/coworkers'], function () {
    Route::resource('departments', DepartmentsController::class);
    Route::resource('/', CoworkersController::class)
        ->names(['create' => 'coworkers.create', 'store' => 'coworkers.store', 'index' => 'coworkers.index']);

    Route::name('coworkers.')->group(function () {
        Route::resource('tickets', TicketController::class)->middleware('auth:coworker');
    });

    Route::get('getCoworkersList/{department}', [CoworkersController::class, 'getCowokersList'])->name('coworkers.list');
    Route::post('referToColleague', [TicketController::class, 'referToColleague'])->name('referToColleague');
});

Route::group(['prefix' => '/coworkers/auth/'], function () {
    Route::get('/login', [CoworkerAuthenticationController::class, 'loginIndex'])->name('coworker.login.index');
    Route::post('/login', [CoworkerAuthenticationController::class, 'login'])->name('coworker.login');
});

