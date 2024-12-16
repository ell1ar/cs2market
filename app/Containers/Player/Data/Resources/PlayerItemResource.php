<?php

namespace App\Containers\Player\Data\Resources;

use App\Ship\Data\Resource;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PlayerMarketItemResource extends Resource
{
    public function __construct(
        public int $id,
        public float $price,
        public string $marketHashName,
        public string $quality,
        public string $rarity,
        public string $uniqid,
        public string $status,
        public int $updatedAt
    ) {}

    public static function fromModel($model): self
    {
        return new self(
            id: $model->id,
            price: round($model->price, 2),
            marketHashName: $model->item->name,
            quality: $model->item->quality,
            rarity: $model->item->rarity,
            uniqid: $model->uniqid,
            status: $model->status,
            updatedAt: $model->updated_at->getPreciseTimestamp(3)
        );
    }
}
