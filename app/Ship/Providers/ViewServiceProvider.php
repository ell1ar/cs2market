<?php

namespace App\Ship\Providers;

use App\Containers\Article\Models\Article;
use App\Containers\AntiplagiatSection\Order\Models\OrderSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layout.footer', function ($view) {
            $view->with('articles', Article::active()->get());
        });
        View::composer('components.quick-start', function ($view) {
            $view->with('order_settings', OrderSettings::first());
        });
    }
}
