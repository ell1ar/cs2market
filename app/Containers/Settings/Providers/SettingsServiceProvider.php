<?php

namespace App\Containers\Settings\Providers;

use App\Containers\Settings\Models\Settings;
use App\Containers\Settings\Observers\SettingsObserver;
use App\Containers\Settings\Tasks\GetSettingsTask;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($settings = app(GetSettingsTask::class)->run()) {
            Config::set('services.steam.client_secret', $settings->data['social']['STEAM_CLIENT_SECRET'] ?? "");
            Config::set('services.telegram.client_secret', $settings->data['social']['TELEGRAM_CLIENT_SECRET'] ?? "");
            Config::set('services.vk.client_secret', $settings->data['social']['VK_CLIENT_SECRET'] ?? "");
        }

        Settings::observe(SettingsObserver::class);

        Relation::morphMap([
            'settings' => Settings::class,
        ]);
    }
}