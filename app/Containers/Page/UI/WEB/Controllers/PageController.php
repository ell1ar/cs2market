<?php

namespace App\Containers\Page\UI\WEB\Controllers;

use App\Containers\Banner\Models\Banner;
use App\Containers\Player\Tasks\GetAuthPlayerTask;
use App\Containers\Player\UI\API\Resources\PlayerItemResource;
use App\Containers\Site\Models\SiteCategory;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index()
    {
        $site_categories = Cache::remember('site-categories', 60 * 60, fn() => SiteCategory::with('sites')->get());
        $banners = Cache::remember('banners', 60 * 60, fn() => Banner::get());

        return Inertia::render('Index', [
            'siteCategories' => $site_categories,
            'banners' => $banners
        ]);
    }

    public function profile()
    {
        $player = app(GetAuthPlayerTask::class)->run();

        return Inertia::render('Profile', [
            'paginate' => PlayerItemResource::collection($player->items()->latest()->paginate(10))
        ]);
    }
}
