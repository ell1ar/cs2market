<?php

namespace App\Containers\Player\Data\Seeders;

use App\Containers\Player\Models\Player;
use App\Ship\Data\BaseSeeder;

class PlayerSeeder extends BaseSeeder
{
    public function getPriority(): int
    {
        return 5;
    }

    public function run()
    {
        if (!app()->environment('production')) {
            Player::factory()
                ->rich()
                ->count(1)
                ->create();
        }
    }
}
