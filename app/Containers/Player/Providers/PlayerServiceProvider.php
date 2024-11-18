<?php

namespace App\Containers\Player\Providers;

use App\Containers\Player\Models\Player;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class PlayerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'player' => Player::class,
        ]);
    }
}
