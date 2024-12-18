<?php

namespace App\Containers\Market\Data\Resources;

use App\Containers\Market\Data\Enums\Market;
use App\Ship\Data\Resource;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class MarketItemResource extends Resource
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $icon,
        public float $price,
        public ?string $quality,
        public ?string $rarity,
        public ?float $float,
        public ?array $stickers,
        public string $classInstance,
        public Market $market
    ) {}
}
