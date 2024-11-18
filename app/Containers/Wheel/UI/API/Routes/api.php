<?php

use App\Containers\Wheel\UI\API\Controllers\WheelPromocodeController;
use Illuminate\Support\Facades\Route;

Route::get('/box/promocode/items', [WheelPromocodeController::class, 'items']);
Route::middleware(['auth:sanctum'])->post('/box/promocode/open', [WheelPromocodeController::class, 'open']);
