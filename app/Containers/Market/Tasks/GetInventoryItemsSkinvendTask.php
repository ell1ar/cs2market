<?php

namespace App\Containers\Market\Tasks;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

final class GetInventoryItemsSkinvendTask implements IGetInventoryItemsTask
{
    public function run(string $trade_link)
    {
        return Cache::remember('inventory_items_' . $trade_link, 60, function () use ($trade_link) {
            $info_trade_link = app(GetInfoFromTradeLinkTask::class)->run($trade_link);
            $steam_id = bcadd((string)$info_trade_link['partner'], '76561197960265728'); // 76561197960265728 — базовое значение Steam ID

            $items = Http::withHeaders([
                'apiKey' => config('markets.skinvend.api_key'),
            ])->get('https://skinvend.io/v1/api/inventory', [
                'app_id' => 730,
                'steam_id' => $steam_id
            ])->throw()->collect();

            return $items->map(fn($item) =>
            [
                'id' => $item['id'],
                'name' => $item['name'],
                'icon' => $item['icon_url'],
                'price' => $item['price'],
                'active' => $item['active'],
                'quality' => $item['quality'],
                'tradable' => (bool) $item['tradable'],
                'class_id' => $item['item_class_id'],
                'instance_id' => $item['asset_id'],
            ]);
        });
    }
}
