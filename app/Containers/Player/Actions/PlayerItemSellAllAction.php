<?php

namespace App\Containers\Player\Actions;

use App\Containers\Player\Data\Enums\PlayerMarketItemStatus;
use App\Containers\Player\Tasks\GetAuthPlayerTask;
use App\Ship\Exceptions\BaseException;
use Illuminate\Support\Facades\DB;

final class PlayerMarketItemSellAllAction
{
    public function run()
    {
        $player_balance = DB::transaction(function () {
            $player = app(GetAuthPlayerTask::class)->run(is_locked: true);

            $player_items = $player->items()->ready()->lockForUpdate()->get();
            if ($player_items->count() === 0) throw new BaseException(__('Items not found'));
            $player_items->each(fn($pi) => $pi->fill(['status' => PlayerMarketItemStatus::Sell])->save());

            $player->balance += $player_items->sum('price');
            $player->save();

            return $player->balance;
        });

        return ['player_balance' => round($player_balance, 2)];
    }
}
