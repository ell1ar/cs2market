<?php

namespace App\Containers\Market\Data\Enums;

enum BuyForStatus: int
{
    case SUCCESS = 2;
    case WAITING = 1;
    case ERROR = 5;
}
