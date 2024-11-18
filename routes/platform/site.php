<?php

use App\Orchid\Screens\Site\SiteEditScreen;
use App\Orchid\Screens\Site\SiteListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Platform > Site > List
Route::screen('sites', SiteListScreen::class)
    ->name('platform.site.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Sites'), route('platform.site.list'));
    });

// Platform > Site > Create
Route::screen('site/create', SiteEditScreen::class)
    ->name('platform.site.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.site.list')
            ->push(__('Create'), route('platform.site.create'));
    });


// Platform > Site > Edit
Route::screen('site/{site}/edit', SiteEditScreen::class)
    ->name('platform.site.edit')
    ->breadcrumbs(function (Trail $trail, $site) {
        return $trail
            ->parent('platform.site.list')
            ->push(__('Edit'), route('platform.site.edit', $site));
    });
