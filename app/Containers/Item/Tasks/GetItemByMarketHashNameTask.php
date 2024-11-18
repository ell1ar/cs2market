<?php

namespace App\Containers\Item\Tasks;

use App\Containers\Item\Models\Item;
use Illuminate\Database\Eloquent\Collection;

final class GetItemByMarketHashNameTask
{
    public function run(string|array $market_hash_names): Item|Collection|null
    {
        if (is_array($market_hash_names)) {
            return Item::whereIn('market_hash_name', $market_hash_names)->get();
        }

        return Item::where('market_hash_name', $market_hash_names)->first();
    }
}
