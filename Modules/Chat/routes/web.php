<?php

use Illuminate\Support\Facades\Route;
use Modules\Chat\App\Http\Controllers\ChatController;

Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function () {

    Route::get('/', [ChatController::class, 'index']);
    Route::post('/send', [ChatController::class, 'send'])->name('send');
    Route::post('/online-users/refresh', [ChatController::class, 'refreshOnlineUsers'])->name('online-users.refresh');

    Route::get('/private-chat/{user:email}/view', [ChatController::class, 'privateChatView'])
        ->name('private-chat-view');

});
