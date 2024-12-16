<?php

namespace App\Ship\Http\Middleware;

use App\Containers\Player\Data\Resources\PlayerResource;
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

        return [
            ...parent::share($request),
            'meta' => function () use ($settings) {
                return $settings->data['meta'];
            },
            'flash' => [
                'error' => $request->session()->get('error'),
                'msg' => $request->session()->get('msg'),
                'success' => $request->session()->get('success'),
            ],
            'auth' => [
                'player' => Auth::guard('players')->user() ? PlayerResource::from(Auth::guard('players')->user()) : null,
                'providers' => [
                    'tg' => (bool) $settings->data['social']['is_telegram_auth'] ?? null,
                    'vk' => (bool) $settings->data['social']['is_vk_auth'] ?? null,
                    'steam' => (bool) $settings->data['social']['is_steam_auth'] ?? null,
                ]
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                    'query' => $request->query()
                ]);
            },
            'locale' => function () {
                return app()->getLocale();
            },
            'currency' => function () use ($request) {
                return [
                    'current' => $request->cookie('currency', 'USD'),
                    'avaiableList' => config('currency.avaiable_list'),
                ];
            },
        ];
    }
}
