<?php

namespace App\Containers\Market\UI\CLI\Commands;

use App\Containers\Market\Data\Enums\MarketTradeStatus;
use App\Containers\Market\Events\NewLiveMarketTradeEvent;
use App\Containers\Market\Models\MarketItem;
use App\Containers\Market\Models\MarketTrade;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class TestLiveMarketTradeCommand extends Command
{
    protected $signature = 'live-market-trade:test';

    protected $description = 'Market items update';

    public function handle()
    {
        $marketTrade = new MarketTrade([
            'class_instance' => MarketItem::inRandomOrder()->first()->class_instance,
            'uuid' => Uuid::uuid4(),
            'paid' => 10,
            'status' => MarketTradeStatus::Traded,
            'result' => 'OK'
        ]);

        event(new NewLiveMarketTradeEvent($marketTrade));
    }
}
