<?php
use App\Orchid\Screens\Statistics\StatisticsScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Platform > Statistics
Route::screen('/statistics', StatisticsScreen::class)
    ->name('platform.statistics')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Статистика'), route('platform.statistics'));
    });