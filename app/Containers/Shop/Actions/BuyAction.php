<?php

namespace App\Containers\Shop\Actions;

use App\Containers\Item\Models\Item;
use App\Containers\Player\Tasks\CreatePlayerItemsTask;
use App\Containers\Player\Tasks\GetAuthPlayerTask;
use App\Ship\Exceptions\BaseException;
use Illuminate\Support\Facades\DB;

final class BuyAction
{
    public function run(float $price)
    {
        DB::transaction(function () use ($price) {
            $player = app(GetAuthPlayerTask::class)->run(is_locked: true);
            if ($player->balance < $price) throw new BaseException(__('Not enough money'));

            $item = Item::where('price', '<=', $price)->first();
            if (!$item) throw new BaseException(__('Item not found'));

            $shop_purchase = $player->shopPurchases()->create([
                'market_hash_name' => $item->market_hash_name,
                'price' => $item->price,
                'quantity' => 1
            ]);

            $player->decrement('balance', $item->price);
            app(CreatePlayerItemsTask::class)->run($player, $shop_purchase, $item);
        });
    }
}
