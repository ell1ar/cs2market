<?php

namespace App\Containers\Market\Contracts;

use App\Containers\Market\Data\Enums\Market;

interface IMarket
{
    public function getType(): Market;
    public function updateMarketItems();
}
