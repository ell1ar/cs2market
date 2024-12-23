<?php

namespace App\Containers\Page\UI\WEB\Controllers;

use App\Containers\Currency\Tasks\GetCurrencyValueTask;
use App\Containers\ExchangeRate\Models\ExchangeRate;
use App\Containers\Market\Data\Resources\InventoryItemResource;
use App\Containers\Market\Data\Resources\MarketItemResource;
use App\Containers\Market\Models\MarketItem;
use App\Containers\Market\Tasks\IGetInventoryItemsTask;
use App\Containers\Currency\Tasks\GetCurrentCurrencyTask;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index()
    {
        return Inertia::render('Index', [
            'statistics' => [
                ['title' => __('Items sold'), 'value' => 100123],
                ['title' => __('Items sold'), 'value' => 100123],
                ['title' => __('Items sold'), 'value' => 100123],
                ['title' => __('Items sold'), 'value' => 100123],
            ]
        ]);
    }

    public function sell(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'sort_dir' => 'nullable|in:asc,desc',
            'trade_link' => 'nullable|string|regex:/^https:\/\/steamcommunity\.com\/tradeoffer\/new\/\?partner=\d+&token=[a-zA-Z0-9]+$/',
        ]);

        $trade_link = $request->get('trade_link') ?? null;

        $inventory_items = [];
        if (!is_null($trade_link)) {
            $inventory_items = app(IGetInventoryItemsTask::class)->run($trade_link);

            if (!is_null($request->get('name')))
                $inventory_items = $inventory_items->filter(fn($item) => stripos($item['name'], $request->get('name')) !== false)->values();

            if (!is_null($request->get('sort_by')) && !is_null($request->get('sort_dir')))
                $inventory_items = $inventory_items->sortBy('price')->values();

            $inventory_items = $inventory_items->map(function ($item) {
                $item['price'] = app(GetCurrencyValueTask::class)->run($item['price']);
                return $item;
            });
        }

        return Inertia::render('Sell', [
            'inventoryItems' => InventoryItemResource::collect($inventory_items)
        ]);
    }

    public function buy(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
        ]);

        $checkbox_filters_json = file_get_contents(storage_path('app/schema/market/checkbox-filters.json'));
        if ($checkbox_filters_json === false) die('Error reading the JSON file');
        $checkbox_filters_json = json_decode($checkbox_filters_json, true);
        if ($checkbox_filters_json === null) die('Error decoding the JSON file');
        $paginate = MarketItem::paginate(30);

        $items = collect($paginate->items())->map(function ($item) {
            $item->price = app(GetCurrencyValueTask::class)->run($item->price);
            return $item;
        });

        $paginate->setCollection($items);

        return Inertia::render('Buy', [
            'checkboxFiltersJson' => $checkbox_filters_json,
            'paginate' => MarketItemResource::collect($paginate)
        ]);
    }

    public function profile()
    {
        return Inertia::render('Profile');
    }

    public function marketDeposit(Request $request)
    {
        return Inertia::render('Deposit', []);
    }
}
