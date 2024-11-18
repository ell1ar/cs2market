<?php

namespace App\Containers\Player\Actions;

use App\Containers\Player\Models\Player;
use App\Containers\Player\Tasks\GetAuthPlayerTask;
use App\Ship\Exceptions\BaseException;
use Illuminate\Support\Facades\DB;

final class SetTradeLinkAction
{
    public function run(string $trade_link)
    {
        DB::transaction(function () use ($trade_link) {
            $player = app(GetAuthPlayerTask::class)->run(is_locked: true);
            if (Player::where([['id', '!=', $player->id], ['trade_link', $trade_link]])->exists())
                throw new BaseException(__('This trade link is already in use. You can generate a new trade link on the Steam website'));

            $player->fill(['trade_link' => $trade_link])->save();
        });
    }
}
