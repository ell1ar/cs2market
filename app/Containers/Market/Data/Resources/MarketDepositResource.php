<?php

namespace App\Containers\Market\Data\Resources;

use App\Containers\Market\Data\Enums\Market;
use App\Containers\Market\Data\Enums\MarketDepositStatus;
use App\Ship\Data\Resource;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class MarketDepositResource extends Resource
{
    public function __construct(
        public string $uuid,
        public $data,
        public Market $market,
        public MarketDepositStatus $status,
        public string $external_id,
    ) {}
}
