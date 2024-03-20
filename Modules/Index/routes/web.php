<?php

use Illuminate\Support\Facades\Route;
use Modules\Index\App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('index.home');
Route::get('/categories/{category:slug}', [IndexController::class, 'categories'])->name('index.categories');
