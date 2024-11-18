<?php

namespace App\Containers\Player\Tasks;

use App\Containers\Player\Models\Player;

final class GetCountPlayersTask
{
    public function run()
    {
        return Player::query()->count();
    }
}
