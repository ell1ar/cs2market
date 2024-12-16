<?php

namespace App\Containers\Market\Contracts;

interface IMarketDeposit extends IMarket
{
    public function deposit($params);
}
