<?php

namespace App\Containers\Player\Tasks;

use Illuminate\Support\Facades\Request;

final class GetCurrentCurrencyTask
{
    public function run()
    {
        return Request::cookie('currency', 'USD');
    }
}
