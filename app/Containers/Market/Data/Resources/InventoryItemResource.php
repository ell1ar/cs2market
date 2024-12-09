<?php

namespace App\Containers\Market\Data\Resources;

use App\Ship\Data\Resource;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class InventoryItemResource extends Resource
{
    public function __construct(
        public string $name,
        public string $icon,
        public float $price,
        public ?string $quality,
        public bool $tradable
    ) {}
}
