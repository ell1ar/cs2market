<?php

namespace App\Containers\Auth\Actions;

use App\Containers\Player\Events\PlayerRegisteredEvent;
use App\Containers\Player\Models\Player;
use Illuminate\Support\Facades\DB;
use SocialiteProviders\Manager\OAuth2\User;

final class RegisterPlayerAction
{
    public function run(User $socialite_info, $provider_info)
    {
        return DB::transaction(function () use ($socialite_info, $provider_info) {
            $player = Player::create([
                'name' => $socialite_info->nickname,
                'image' => $socialite_info->avatar,
            ]);

            $provider_info['model']::create(['player_id' => $player->id, $provider_info['id'] => $socialite_info->id]);

            event(new PlayerRegisteredEvent($player));
            return $player;
        });
    }
}
