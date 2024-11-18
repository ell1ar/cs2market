<?php

namespace App\Containers\Wheel\Providers;

use App\Containers\Player\Models\Player;
use App\Containers\Wheel\Models\WheelPromocode;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class WheelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'player' => Player::class,
        ]);

        Player::resolveRelationUsing('wheelPromocodes', function (Player $player) {
            return $player->belongsToMany(WheelPromocode::class, 'wheel_promocode_player');
        });
    }
}
