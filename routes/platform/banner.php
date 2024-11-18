<?php

use App\Orchid\Screens\Banner\BannerEditScreen;
use App\Orchid\Screens\Banner\BannerListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Platform > Banner > List
Route::screen('banners', BannerListScreen::class)
    ->name('platform.banner.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Banners'), route('platform.banner.list'));
    });

// Platform > Banner > Edit
Route::screen('banner/{banner}/edit', BannerEditScreen::class)
    ->name('platform.banner.edit')
    ->breadcrumbs(function (Trail $trail, $banner) {
        return $trail
            ->parent('platform.banner.list')
            ->push(__('Edit'), route('platform.banner.edit', $banner));
    });

// Platform > Banner > Create
Route::screen('banner/create', BannerEditScreen::class)
    ->name('platform.banner.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.banner.list')
            ->push(__('Create'), route('platform.banner.create'));
    });
