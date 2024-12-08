<?php

namespace App\Containers\Player\UI\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerMarketItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => round($this->price, 2),
            'marketHashName' => $this->item->name,
            'quality' => $this->item->quality,
            'rarity' => $this->item->rarity,
            'uniqid' => $this->uniqid,
            'status' => $this->status,
            'updatedAt' => $this->updated_at->getPreciseTimestamp(3),
        ];
    }
}
