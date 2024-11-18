<?php

use App\Containers\Page\UI\WEB\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('index');
Route::middleware('auth:players')->get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/agreement', [PageController::class, 'agreement'])->name('agreement');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
