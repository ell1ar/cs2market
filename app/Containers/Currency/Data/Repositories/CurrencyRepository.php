<?php

namespace App\Containers\Currency\Data\Repositories;

class CurrencyRepository
{
    public function getCurrentCurrency()
    {
        return session('currency', "USD");
    }
}
