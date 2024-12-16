<?php

use App\Containers\Market\UI\WEB\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

Route::prefix('market')->as('market.')->group(function () {
    Route::post('/sell', [MarketController::class, 'sell'])->name('sell');
});
