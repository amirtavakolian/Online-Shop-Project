<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
