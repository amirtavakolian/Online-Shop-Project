<?php

use Illuminate\Support\Facades\Route;
use Modules\Panel\App\Http\Controllers\PanelController;

Route::get('/panel', function () {
    return view('panel::index');

});
