<?php

namespace App\Containers\Player\Data\Enums;

enum PlayerItemStatus : int {
    case Ready = 1;
    case Sell = 0;
    case Upgrade = 11;
    case Contract = 12;
    case BattleSkins = 13;
    case Wheel = 14;
    case Trade = 5;
    case TradeProccess = 3;
    case TradeWait = 2;
}
