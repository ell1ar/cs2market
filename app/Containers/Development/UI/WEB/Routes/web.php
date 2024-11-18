<?php

use App\Containers\Development\UI\WEB\Controllers\DevController;
use Illuminate\Support\Facades\Route;

Route::get('/dev', [DevController::class, 'dev']);
Route::get('/fake-auth/{id}', [DevController::class, 'fakeAuth']);
