<?php

use Illuminate\Support\Facades\Route;
use Modules\Ticket\App\Http\Controllers\TicketController;

Route::group(['prefix' => '/panel'], function () {
    Route::resource('tickets', TicketController::class);
});
