<?php

use Illuminate\Support\Facades\Route;
use Modules\Ticket\App\Enum\TicketStatus;
use Modules\Ticket\App\Http\Controllers\TicketController;

Route::group([], function () {
    Route::resource('tickets', TicketController::class);
});
