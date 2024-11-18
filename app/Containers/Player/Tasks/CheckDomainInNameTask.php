<?php

namespace App\Containers\Player\Tasks;

use App\Containers\Player\Models\Player;

final class CheckDomainInNameTask
{
    public function run(Player $player)
    {
        return strpos(strtolower($player->name), strtolower(env('APP_DOMAIN'))) !== false;
    }
}
