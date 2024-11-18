<?php

namespace App\Containers\Player\Data\Factories;

use App\Containers\Item\Models\Item;
use App\Containers\Player\Data\Enums\PlayerItemStatus;
use App\Containers\Player\Models\PlayerItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerItemFactory extends Factory
{
    protected $model = PlayerItem::class;

    public function definition()
    {
        $item = Item::inRandomOrder()->first();

        return [
            'market_hash_name' => $item->market_hash_name,
            'dropable_type' => 'test',
            'dropable_id' => 1,
            'status' => PlayerItemStatus::Ready,
            'price' => $item->price,
            'uniqid' => uniqid(),
        ];
    }
}
