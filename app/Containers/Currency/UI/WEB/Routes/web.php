<?php

use App\Containers\Currency\UI\WEB\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;

Route::post('/currency/set', [CurrencyController::class, 'setCurrency']);
