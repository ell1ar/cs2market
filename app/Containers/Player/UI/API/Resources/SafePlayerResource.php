<?php

namespace App\Containers\Player\UI\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SafePlayerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
        ];
    }
}
