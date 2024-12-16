<?php

namespace App\Containers\Player\Data\Resources;

use App\Ship\Data\Resource;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SafePlayerResource extends Resource
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $image
    ) {}
}
