<?php

namespace App\Containers\Market\Data\Enums;

enum MarketTradeStatus: string
{
    case Traded = 'traded';
    case Wait = 'wait';
    case Fail = 'fail';
    case Proccessing = 'proccessing';
}
