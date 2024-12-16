<?php

use App\Containers\Player\UI\WEB\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('player')->as('player.')->post('/info', [PlayerController::class, 'info'])->name('info');
});
