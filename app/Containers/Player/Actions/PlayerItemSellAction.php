<?php

namespace App\Containers\Player\Actions;

use App\Containers\Player\Data\Enums\PlayerItemStatus;
use App\Containers\Player\Tasks\GetAuthPlayerTask;
use App\Ship\Exceptions\BaseException;
use Illuminate\Support\Facades\DB;

final class PlayerItemSellAction
{
    public function run(string $uniqid)
    {
        DB::transaction(function () use ($uniqid) {
            $player = app(GetAuthPlayerTask::class)->run(is_locked: true);
            $player_item = $player->items()->ready()->where('uniqid', $uniqid)->lockForUpdate()->first();
            if (!$player_item) throw new BaseException(__('Item not found'));

            $player_item->fill(['status' => PlayerItemStatus::Sell])->save();
            $player->increment('balance', $player_item->price);

            return $player;
        });
    }
}
