<?php

namespace App\Containers\Site\Providers;

use App\Containers\Site\Models\Site;
use App\Containers\Site\Observers\SiteObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Site::observe(SiteObserver::class);

        Relation::morphMap([
            'site' => Site::class,
        ]);
    }
}
