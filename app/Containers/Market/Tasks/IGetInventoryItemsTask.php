<?php

namespace App\Containers\Market\Tasks;

interface IGetInventoryItemsTask
{
    public function run(string $trade_link);
}
