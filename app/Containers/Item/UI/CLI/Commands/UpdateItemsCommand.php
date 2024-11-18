<?php

namespace App\Containers\Item\UI\CLI\Commands;

use App\Containers\ExchangeRate\Models\ExchangeRate;
use App\Containers\Item\Models\Item;
use App\Containers\Item\Tasks\GetItemQualityTask;
use App\Containers\Item\Tasks\GetItemRarityTask;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class UpdateItemsCommand extends Command
{
    const PRECENT_TO_PRICE = 20;
    protected $signature = 'item:update';

    protected $description = 'Update items';

    public function handle()
    {
        $source = 'https://market.csgo.com/api/v2/prices/class_instance/RUB.json';

        $get_item_rarity_task = app(GetItemRarityTask::class);
        $get_item_quality_task = app(GetItemQualityTask::class);
        $exchange_rate_usd = ExchangeRate::USD()->first();
        if (!$exchange_rate_usd) throw new \Exception('Exchange rate usd not found');

        $lazyCollection = LazyCollection::fromJson($source, 'items')
            ->map(function ($item, $class_instance) use ($exchange_rate_usd, $get_item_rarity_task, $get_item_quality_task) {
                $price = $item['price'] / ($exchange_rate_usd->in_rub / $exchange_rate_usd->nominal);

                return [
                    'market_hash_name' => $item['market_hash_name'],
                    'ru_market_hash_name' => $item['ru_name'],
                    'price' => $price + ($price * self::PRECENT_TO_PRICE / 100),
                    'price_market' => $price,
                    'quantity' => 1,
                    'quality' => $get_item_quality_task->run($item['market_hash_name']),
                    'rarity' => $get_item_rarity_task->run($item['ru_rarity'], $item['market_hash_name']),
                    'class_instance' => $class_instance
                ];
            })->filter(function ($item) {
                return
                    strpos($item['market_hash_name'], 'Case Key') === false &&
                    strpos($item['market_hash_name'], 'Capsule') === false &&
                    strpos($item['market_hash_name'], 'Music Kit') === false &&
                    strpos($item['market_hash_name'], 'Graffiti') === false &&
                    strpos($item['market_hash_name'], 'Overpass') === false &&
                    strpos($item['market_hash_name'], 'Viewer Pass') === false &&
                    strpos($item['market_hash_name'], 'Operation') === false &&
                    strpos($item['market_hash_name'], 'Patch |') === false;
            });

        $items = self::getUniqueItems($lazyCollection);

        self::updateDB($items);
    }

    private static function getUniqueItems($collection): array
    {
        $items = [];
        foreach ($collection as $item) {
            if (isset($items[$item['market_hash_name']])) {
                $items[$item['market_hash_name']]['quantity']++;

                if ($items[$item['market_hash_name']]['price'] > $item['price']) {
                    $items[$item['market_hash_name']]['price'] = $item['price'];
                    $items[$item['market_hash_name']]['price_market'] = $item['price_market'];
                }

                continue;
            }
            $items[$item['market_hash_name']] = $item;
        }
        return $items;
    }

    private static function updateDB(array $items): void
    {
        DB::transaction(function () use ($items) {
            $not_updatable_market_hash_names = Item::where('is_updatable', false)->pluck('market_hash_name')->toArray();
            $updatable_market_hash_names = collect($items)->filter(fn($item) => !in_array($item['market_hash_name'], $not_updatable_market_hash_names))->keys()->toArray();

            Item::whereIn('market_hash_name', $updatable_market_hash_names)->delete();
            Item::whereNotIn('market_hash_name', array_merge($updatable_market_hash_names, $not_updatable_market_hash_names))->update(['quantity' => 0]);
            $chunks = array_chunk($items, 200);
            foreach ($chunks as $chunk)
                Item::insert($chunk);
        });
    }
}
