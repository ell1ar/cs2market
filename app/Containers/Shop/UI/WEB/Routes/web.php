<?php

use App\Containers\Shop\UI\WEB\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('shop')->as('shop.')->group(function () {
        Route::post('buy', [ShopController::class, 'buy'])->name('buy');
    });
});
