<?php

namespace App\Containers\Site\Observers;

use Illuminate\Support\Facades\Cache;

class SiteObserver
{
    public function created()
    {
        Cache::forget('site-categories');
    }

    public function updated()
    {
        Cache::forget('site-categories');
    }

    public function deleted()
    {
        Cache::forget('site-categories');
    }

    public function restored()
    {
        Cache::forget('site-categories');
    }

    public function forceDeleted()
    {
        Cache::forget('site-categories');
    }
}
