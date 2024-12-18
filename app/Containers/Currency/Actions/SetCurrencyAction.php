<?php

namespace App\Containers\Currency\Actions;

final class SetCurrencyAction
{
    public function run($currency)
    {
        session(['currency' => $currency]);
    }
}
