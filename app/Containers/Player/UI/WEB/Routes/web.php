<?php

use App\Containers\Player\UI\WEB\Controllers\PlayerController;
use App\Containers\Player\UI\WEB\Controllers\PlayerItemController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('player-item')->as('player-item.')->group(function () {
        Route::post('trade', [PlayerItemController::class, 'trade'])->name('trade');
        Route::post('sell', [PlayerItemController::class, 'sell'])->name('sell');
        Route::post('sell/all', [PlayerItemController::class, 'sellAll'])->name('sell-all');
    });
    Route::prefix('player')->as('player.')->post('/info', [PlayerController::class, 'info'])->name('info');
});
