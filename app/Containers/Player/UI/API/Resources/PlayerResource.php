<?php

namespace App\Containers\Player\UI\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'balance' => (float) $this->balance,
            'image' => $this->image,
        ];
    }
}
