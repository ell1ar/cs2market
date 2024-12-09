<?php

namespace App\Containers\Market\Tasks;

use App\Containers\Market\Models\MarketItem;

final class GetMarketItemsTask
{
    public function run()
    {
        return MarketItem::all();
    }
}
