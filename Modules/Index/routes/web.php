<?php

use Illuminate\Support\Facades\Route;
use Modules\Index\App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('index.home');
