<?php

namespace App\Ship\Providers;

use App\Containers\Market\Tasks\GetInventoryItemsSkinvendTask;
use App\Containers\Market\Tasks\IGetInventoryItemsTask;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IGetInventoryItemsTask::class, GetInventoryItemsSkinvendTask::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->environment('stage', 'production')) {
            URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');
        }
    }
}
