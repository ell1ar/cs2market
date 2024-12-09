<?php

namespace App\Containers\Market\Markets;

use App\Containers\ExchangeRate\Models\ExchangeRate;
use App\Containers\Market\Data\Enums\Market;
use App\Containers\Market\Models\MarketItem;
use App\Containers\Market\Tasks\GetRariryByNameTask;

class MarketCSGO implements IMarket
{
    public function updateMarketItems()
    {
        $exchange_rate_usd = ExchangeRate::USD()->first();
        if (!$exchange_rate_usd) throw new \Exception('Exchange rate usd not found');

        $source = 'https://market.csgo.com/api/v2/prices/class_instance/RUB.json';
        $json = file_get_contents($source);
        $json = collect(json_decode($json, true, JSON_THROW_ON_ERROR)['items']);
        $json->map(fn($item, $class_instance) => [
            'name' => $item['market_hash_name'],
            'price' => $item['price'] / ($exchange_rate_usd->in_rub / $exchange_rate_usd->nominal),
            'quality' => app(GetRariryByNameTask::class)->run($item['market_hash_name']),
            'rarity' => $this->getRarity($item['ru_rarity'], $item['market_hash_name']),
            'class_instance' => $class_instance,
            'market' => Market::MarketCSGO,
            'market_info' => json_encode($item)
        ])->unique('class_instance')->chunk(500)
            ->each(function ($chunk) {
                MarketItem::upsert($chunk->toArray(), uniqueBy: ['class_instance'], update: ['price', 'market_info']);
            });
    }

    public function buyFor() {}

    private function getRarity($ru_rarity, $name): string
    {
        $rarity = 'common';
        if ($ru_rarity == "Ширпотреб" || $ru_rarity == "базового класса" || $ru_rarity == "Consumer Grade" || $ru_rarity == "Base Grade") {
            $rarity = 'common';
        } elseif ($ru_rarity == "Промышленное качество" || $ru_rarity == "Industrial Grade") {
            $rarity = 'uncommon';
        } elseif ($ru_rarity == "Высшего класса" || $ru_rarity == "высшего класса" || $ru_rarity == "High Grade" || $ru_rarity == "Mil-Spec Grade" || $ru_rarity == "Армейское качество" || $ru_rarity == "Distinguished") {
            $rarity = 'milspec';
        } elseif ($ru_rarity == "Remarkable" || $ru_rarity == "Restricted" || $ru_rarity == "Запрещенное" || $ru_rarity == "Запрещённое") {
            $rarity = 'restricted';
        } elseif ($ru_rarity == "Classified" || $ru_rarity == "экзотичного вида" || $ru_rarity == "Засекреченное" || $ru_rarity == "Превосходный") {
            $rarity = 'classified';
        } elseif ($ru_rarity == "Covert" || $ru_rarity == "Extraordinary" || $ru_rarity == "экстраординарного типа" || $ru_rarity == "Тайное" || $ru_rarity == "Мастерский") {
            $rarity = 'covert';
        } elseif (strpos($name, 'Knife') !== false) {
            $rarity = 'rare';
        }
        return $rarity;
    }
}
