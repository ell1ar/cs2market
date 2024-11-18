<?php

namespace App\Containers\MarketCSGO\Data\Enums;

enum BuyForStatus: int
{
    case SUCCESS = 2;
    case WAITING = 1;
    case ERROR = 5;
}
