<?php

namespace App\Containers\Market\Actions;

use App\Containers\Market\Contracts\IMarketDeposit;
use App\Containers\Market\Data\Enums\MarketDepositStatus;
use App\Containers\Player\Tasks\GetAuthPlayerTask;
use Illuminate\Support\Facades\DB;

final class SellAction
{
    public function run($params)
    {
        $player = app(GetAuthPlayerTask::class)->run();
        $market = app(IMarketDeposit::class);

        DB::transaction(function () use ($player, $market, $params) {
            $player->marketDeposits()->create([
                'data' => $params,
                'market' => $market->getType(),
                'status' => MarketDepositStatus::Proccessing
            ]);
        });
    }
}
