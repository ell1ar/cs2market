<?php

namespace App\Containers\Player\Tasks;

use App\Containers\Player\Data\Enums\PlayerMarketItemStatus;
use App\Containers\Player\Models\Player;
use Illuminate\Support\Str;

final class CreatePlayerMarketItemsTask
{
    public function run(Player $player, $dropable_instance, ...$items)
    {
        return collect($items)->map(function ($item) use ($player, $dropable_instance) {
            return $player->items()->create([
                'name' => $item->name,
                'price' => $item->price,
                'uniqid' => Str::random(36),
                'dropable_type' => $dropable_instance->getMorphClass(),
                'dropable_id' => $dropable_instance->id,
                'status' => PlayerMarketItemStatus::Ready
            ]);
        });
    }
}
