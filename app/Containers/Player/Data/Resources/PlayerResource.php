<?php

namespace App\Containers\Player\Data\Resources;

use App\Ship\Data\Resource;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class PlayerResource extends Resource
{
    public function __construct(
        public int $id,
        public string $name,
        public float $balance,
        public string $image,
        public ?string $tradeLink
    ) {}

    public static function fromModel($player): self
    {
        return new self(
            id: $player->id,
            name: $player->name,
            balance: (float) $player->balance,
            image: $player->image,
            tradeLink: $player->trade_link,
        );
    }
}
