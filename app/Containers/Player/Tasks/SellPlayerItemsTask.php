<?php

namespace App\Containers\Player\Tasks;

use App\Containers\Player\Data\Enums\PlayerItemStatus;
use App\Containers\Player\Models\Player;
use App\Ship\Exceptions\BaseException;

final class SellPlayerItemsTask
{
    public function run(Player $player, ...$uniqids)
    {
        $player_items = $player->items()->ready()->whereIn('uniqid', $uniqids)->lockForUpdate()->first();
        if ($player_items->count() != count($uniqids)) throw new BaseException(__('Items not found'));

        $player_items->each(fn($pi) => $pi->fill(['status' => PlayerItemStatus::Sell])->save());
        $player->balance += $player_items->sum('price');
        $player->save();
    }
}
