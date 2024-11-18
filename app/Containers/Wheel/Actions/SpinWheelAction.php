<?php

namespace App\Containers\Wheel\Actions;

use App\Containers\Wheel\Data\Transporters\SpinWheeDTO;
use App\Containers\Wheel\Models\WheelPromocode;
use App\Containers\Item\Tasks\GetRandomItemLowerThanTask;
use App\Containers\LiveDrop\Events\NewLiveDropEvent;
use App\Containers\Player\Tasks\CreatePlayerItemsTask;
use App\Containers\Player\Tasks\GetAuthPlayerTask;
use App\Containers\Settings\Tasks\GetSettingsTask;
use App\Ship\Exceptions\BaseException;
use Illuminate\Support\Facades\DB;

final class SpinWheelAction
{
    public function run(SpinWheeDTO $dto): array
    {
        $wheel_promocode = WheelPromocode::where('value', $dto->promocode_value)->first();
        if (!$wheel_promocode) throw new BaseException(__('Promo code not found'));

        $player = app(GetAuthPlayerTask::class)->run();
        if ($player->wheelPromocodes()->where('wheel_promocodes.id', $wheel_promocode->id)->exists())
            throw new BaseException(__('You have already used this promo code'));

        $settings = app(GetSettingsTask::class)->run();
        if (is_null($settings->data['wheel']['limit_max_price'])) throw new BaseException(__('Not available. Try later.'));
        $win_item = app(GetRandomItemLowerThanTask::class)->run($settings->data['wheel']['limit_max_price']);
        if (!$win_item) throw new BaseException(__('Items in the case are currently not available. Try later...'));

        return DB::transaction(function () use ($player, $dto, $win_item) {
            $wheel_promocode = WheelPromocode::where('value', $dto->promocode_value)->lockForUpdate()->first();
            if (!is_null($wheel_promocode->limit)) {
                if ($wheel_promocode->limit <= 0) throw new BaseException(__('Promo code limit expired'));
                $wheel_promocode->decrement("limit");
            }

            $player->wheelPromocodes()->attach($wheel_promocode);
            $win_player_item = app(CreatePlayerItemsTask::class)->run($player, $wheel_promocode, $win_item)[0];

            event(new NewLiveDropEvent($player, $win_player_item->item));
            return ["win_player_item" => $win_player_item];
        });
    }
}
