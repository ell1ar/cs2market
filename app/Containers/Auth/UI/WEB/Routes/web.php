<?php

use App\Containers\Auth\UI\WEB\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:sanctum'])->group(function () {
    Route::get('auth/{provider}', [AuthController::class, 'auth'])->name('auth');
    Route::get('auth/handle/{provider}', [AuthController::class, 'handle'])->name('auth.handle');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::any('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
