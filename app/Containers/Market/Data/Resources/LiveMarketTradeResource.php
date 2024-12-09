<?php

namespace App\Containers\Market\Data\Resources;

use App\Containers\Market\Data\Resources\MarketItemResource;
use App\Ship\Data\Resource;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class LiveMarketTradeResource extends Resource
{
    public function __construct(
        public MarketItemResource $marketItem
    ) {}
}
