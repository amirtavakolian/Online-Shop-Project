<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('panel::index');
})->name('panel')->middleware(['web', 'auth', 'active.email']);
