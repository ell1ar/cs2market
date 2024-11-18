<?php

declare(strict_types=1);

namespace App\Orchid;

use Illuminate\Support\Facades\View;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        View::addNamespace('admin', resource_path('admin/views'));
    }

    public function menu(): array
    {
        return [
            Menu::make(__('Players'))
                ->route('platform.player.list'),

            Menu::make(__('Sites'))
                ->list([
                    Menu::make(__('List'))->route('platform.site.list'),
                    Menu::make(__('Categories'))->route('platform.site-category.list'),
                ]),

            Menu::make(__('Wheel promocodes'))
                ->route('platform.wheel-promocode.list'),

            Menu::make(__('Banners'))
                ->route('platform.banner.list'),

            Menu::make(__('Settings'))
                ->route('platform.settings'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
