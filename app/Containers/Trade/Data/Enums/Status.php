<?php

namespace App\Containers\Trade\Data\Enums;

enum Status: string
{
    case Traded = 'traded';
    case Wait = 'wait';
    case Fail = 'fail';
    case Proccessing = 'proccessing';
}
