<?php

use App\Orchid\Screens\WheelPromocode\WheelPromocodeEditScreen;
use App\Orchid\Screens\WheelPromocode\WheelPromocodeListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Platform > WheelPromocode > List
Route::screen('wheel-promocodes', WheelPromocodeListScreen::class)
    ->name('platform.wheel-promocode.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('WheelPromocodes'), route('platform.wheel-promocode.list'));
    });

// Platform > WheelPromocode > Edit
Route::screen('wheel-promocode/{wheel_promocode}/edit', WheelPromocodeEditScreen::class)
    ->name('platform.wheel-promocode.edit')
    ->breadcrumbs(function (Trail $trail, $wheel_promocode) {
        return $trail
            ->parent('platform.wheel-promocode.list')
            ->push(__('Edit'), route('platform.wheel-promocode.edit', $wheel_promocode));
    });

// Platform > WheelPromocode > Create
Route::screen('wheel-promocode/create', WheelPromocodeEditScreen::class)
    ->name('platform.wheel-promocode.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.wheel-promocode.list')
            ->push(__('Create'), route('platform.wheel-promocode.create'));
    });
