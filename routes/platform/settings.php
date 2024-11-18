<?php

use App\Orchid\Screens\Settings\SettingsEditScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

Route::screen('settings', SettingsEditScreen::class)
    ->name('platform.settings')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Settings'), route('platform.settings'));
    });
