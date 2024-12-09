<?php

namespace App\Containers\Market\Events;

use App\Containers\Market\Data\Resources\LiveMarketTradeResource;
use App\Containers\Market\Data\Resources\MarketItemResource;
use App\Containers\Market\Models\MarketTrade;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewLiveMarketTradeEvent implements ShouldBroadcast, ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    public $liveMarketTrade;

    public function __construct(MarketTrade $market_trade)
    {
        $this->liveMarketTrade = new LiveMarketTradeResource(MarketItemResource::from($market_trade->item));
    }

    public function broadcastOn()
    {
        return new Channel('public:live-market-trades');
    }
}
