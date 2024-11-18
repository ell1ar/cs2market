<?php

namespace App\Containers\LiveDrop\UI\API\Resources;

use App\Containers\Item\UI\API\Resources\ItemResource;
use App\Containers\Player\UI\API\Resources\SafePlayerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LiveDropResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'player' => new SafePlayerResource($this['player']),
            'item' => new ItemResource($this['item']),
        ];
    }
}
