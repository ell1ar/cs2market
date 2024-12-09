<?php

namespace App\Containers\Market\Providers;

use App\Containers\Player\Models\Player;
use App\Containers\Market\Models\MarketTrade;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class MarketTradeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'marketTrade' => MarketTrade::class,
        ]);

        Player::resolveRelationUsing('marketTrades', function (Player $player) {
            return $player->hasMany(MarketTrade::class, 'player_id');
        });
    }
}
