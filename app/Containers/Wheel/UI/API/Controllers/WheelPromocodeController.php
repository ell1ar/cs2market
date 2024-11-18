<?php

namespace App\Containers\Wheel\UI\API\Controllers;

use App\Containers\Wheel\Actions\SpinWheelAction;
use App\Containers\Wheel\Data\Transporters\SpinWheeDTO;
use App\Containers\Item\Tasks\GetRandomItemsBetweenTask;
use App\Containers\Item\UI\API\Resources\ItemResource;
use App\Containers\Player\UI\API\Resources\PlayerItemResource;
use App\Ship\Http\Controllers\Controller;

class WheelPromocodeController extends Controller
{
    public function items()
    {
        $items = app(GetRandomItemsBetweenTask::class)->run(1, 50, 12);

        return response()->json([
            'status' => 'success',
            'data' => [
                'items' => ItemResource::collection($items)
            ]
        ]);
    }

    public function open(SpinWheeDTO $dto)
    {
        $data = app(SpinWheelAction::class)->run($dto);

        return response()->json([
            'status' => 'success',
            'data' => [
                'winPlayerItem' => new PlayerItemResource($data['win_player_item'])
            ]
        ]);
    }
}
