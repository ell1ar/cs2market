<?php

namespace App\Ship\Http\Middleware;

use App\Containers\Settings\Tasks\GetSettingsTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $settings = app(GetSettingsTask::class)->run();

        $meta = $settings->data['meta'];

        $social = [
            'isTelegramAuth' => (bool) $settings->data['social']['is_telegram_auth'] ?? null,
            'isVkAuth' => (bool) $settings->data['social']['is_vk_auth'] ?? null,
            'isSteamAuth' => (bool) $settings->data['social']['is_steam_auth'] ?? null,
        ];

        return [
            ...parent::share($request),
            'meta' => fn() => $meta,
            'social' => fn() => $social,
            'flash' => [
                'error' => fn() => $request->session()->get('error'),
                'msg' => fn() => $request->session()->get('msg'),
                'success' => fn() => $request->session()->get('success'),
            ],
            'auth' => [
                'player' => Auth::guard('players')->user() ?? null,
            ],
            'ziggy' => fn() => [
                ...(new Ziggy())->toArray(),
                'location' => $request->url(),
            ],
            'locale' => function () {
                return app()->getLocale();
            },
        ];
    }
}