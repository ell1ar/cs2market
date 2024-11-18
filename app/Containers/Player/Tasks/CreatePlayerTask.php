<?php

namespace App\Containers\Player\Tasks;

use App\Containers\Player\Models\Player;

final class CreatePlayerTask
{
    public function run($params): Player
    {
        return Player::create($params);
    }
}
