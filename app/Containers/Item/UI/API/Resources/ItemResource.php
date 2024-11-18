<?php

namespace App\Containers\Item\UI\API\Resources;

use App\Containers\Item\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'marketHashName' => $this->market_hash_name,
            'price' => round($this->price, 2),
            'quantity' => $this->quantity,
            'quality' => $this->quality,
            'count' => $this->count,
            'rarity' => $this->rarity,
            'rarityWeigth' => $this->rarityWeigth,
        ];
    }
}
