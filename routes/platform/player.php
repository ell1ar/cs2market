<?php

use App\Orchid\Screens\Player\PlayerEditScreen;
use App\Orchid\Screens\Player\PlayerListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Platform > Player > List
Route::screen('players', PlayerListScreen::class)
    ->name('platform.player.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Players'), route('platform.player.list'));
    });

// Platform > Player > Edit
Route::screen('player/{player}/edit', PlayerEditScreen::class)
    ->name('platform.player.edit')
    ->breadcrumbs(function (Trail $trail, $player) {
        return $trail
            ->parent('platform.player.list')
            ->push(__('Edit'), route('platform.player.edit', $player));
    });
