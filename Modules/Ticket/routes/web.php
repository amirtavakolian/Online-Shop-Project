<?php

use Illuminate\Support\Facades\Route;
use Modules\Ticket\App\Http\Controllers\TicketController;

Route::group([], function () {
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/storeReply', [TicketController::class, 'storeReply'])->name('ticket.store.reply');
});
