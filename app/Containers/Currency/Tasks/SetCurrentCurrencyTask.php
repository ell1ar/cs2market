<?php

namespace App\Containers\Player\Tasks;

use Illuminate\Support\Facades\Cookie;

final class SetCurrentCurrencyTask
{
    public function run(string $currency)
    {
        return Cookie::queue('currency', $currency, 60 * 24 * 30);
    }
}
