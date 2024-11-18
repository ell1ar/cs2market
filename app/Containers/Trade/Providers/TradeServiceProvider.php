<?php

namespace App\Containers\Trade\Providers;

use App\Containers\Player\Models\Player;
use App\Containers\Trade\Models\Trade;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class TradeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'trade' => Trade::class,
        ]);

        Player::resolveRelationUsing('trades', function (Player $player) {
            return $player->hasMany(Trade::class, 'player_id');
        });
    }
}
