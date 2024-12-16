<?php

namespace App\Containers\Market\Data\Enums;

enum MarketDepositStatus: string
{
    case Success = 'success';
    case Fail = 'fail';
    case Proccessing = 'proccessing';
}
