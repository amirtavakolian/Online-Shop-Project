<?php

use Illuminate\Support\Facades\Route;
use Modules\Banner\App\Http\Controllers\BannerController;

Route::group(['prefix' => '/panel'], function () {
    Route::resource('banners', BannerController::class)
        ->except('show')
        ->names([
            'index' => 'panel.banners.index',
            'create' => 'panel.banners.create',
            'store' => 'panel.banners.store',
            'edit' => 'panel.banners.edit',
            'update' => 'panel.banners.update',
        ]);
});

