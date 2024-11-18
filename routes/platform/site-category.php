<?php

use App\Orchid\Screens\Site\SiteCategoryEditScreen;
use App\Orchid\Screens\Site\SiteCategoryListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

// Platform > SiteCategory > List
Route::screen('site-categories', SiteCategoryListScreen::class)
    ->name('platform.site-category.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Sites'), route('platform.site-category.list'));
    });

// Platform > SiteCategory > Edit
Route::screen('site-category/{site_category}/edit', SiteCategoryEditScreen::class)
    ->name('platform.site-category.edit')
    ->breadcrumbs(function (Trail $trail, $site_category) {
        return $trail
            ->parent('platform.site-category.list')
            ->push(__('Edit'), route('platform.site-category.edit', $site_category));
    });

// Platform > SiteCategory > Create
Route::screen('site-category/create', SiteCategoryEditScreen::class)
    ->name('platform.site-category.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.site-category.list')
            ->push(__('Create'), route('platform.site-category.create'));
    });
