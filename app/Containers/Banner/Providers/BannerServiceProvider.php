<?php

namespace App\Containers\Banner\Providers;

use App\Containers\Banner\Models\Banner;
use App\Containers\Banner\Observers\BannerObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class BannerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Banner::observe(BannerObserver::class);

        Relation::morphMap([
            'banner' => Banner::class,
        ]);
    }
}
