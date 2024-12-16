<?php

namespace App\Containers\Market\Markets;

use App\Containers\Market\Contracts\IMarketDeposit;
use App\Containers\Market\Contracts\IMarket;
use App\Containers\Market\Data\Enums\Market;
use App\Containers\Market\Models\MarketItem;
use App\Containers\Market\Tasks\GetQualityByNameTask;
use Illuminate\Support\Facades\Http;

class Skinvend implements IMarket, IMarketDeposit
{
    public function getType(): Market
    {
        return Market::Skinvend;
    }

    public function updateMarketItems()
    {
        $items = Http::timeout(30)->withHeaders([
            'apiKey' => config('markets.skinvend.api_key'),
        ])->get('https://skinvend.io/v1/api/items/search', [
            'app_id' => "730",
            'full_list' => "true",
        ])->throw()->collect();

        $items->map(fn($item) => [
            'icon' => $item['icon_url'],
            'name' => $item['full_name'],
            'price' => $item['price'],
            'quality' => app(GetQualityByNameTask::class)->run($item['full_name']),
            'class_instance' => $item['class_id'] . '_' . $item['instance_id'],
            'market' => Market::Skinvend,
            'market_info' => json_encode($item)
        ])->unique('class_instance')->chunk(500)
            ->each(function ($chunk) {
                MarketItem::upsert($chunk->toArray(), uniqueBy: ['class_instance'], update: ['icon', 'price', 'market_info']);
            });
    }

    public function deposit($params)
    {
        return Http::timeout(30)->withHeaders([
            'apiKey' => config('markets.skinvend.api_key'),
        ])->get('https://skinvend.io/v1/api/deposit', [
            'deposit_id' => $params['deposit_id'],
            'steam_id' => $params['steam_id'],
        ])->throw()->collect();
    }

    public function trade($params)
    {
        return Http::timeout(30)->withHeaders([
            'apiKey' => config('markets.skinvend.api_key'),
        ])->get('https://skinvend.io/v1/api/inventory/trade', [
            'app_id' => $params['app_id'],
            'trade_id' => $params['trade_id'],
            'trade_url' => $params['trade_url'],
            'items_array' => $params['items_array'],
        ])->throw()->collect();
    }
}
