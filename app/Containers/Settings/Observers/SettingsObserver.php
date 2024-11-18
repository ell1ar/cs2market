<?php

namespace App\Containers\Settings\Observers;

use Illuminate\Support\Facades\Cache;

class SettingsObserver
{
    public function created()
    {
        Cache::forget('settings');
    }

    public function updated()
    {
        Cache::forget('settings');
    }

    public function deleted()
    {
        Cache::forget('settings');
    }

    public function restored()
    {
        Cache::forget('settings');
    }

    public function forceDeleted()
    {
        Cache::forget('settings');
    }
}
