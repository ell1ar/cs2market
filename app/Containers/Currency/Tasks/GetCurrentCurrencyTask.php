<?php

namespace App\Containers\Currency\Tasks;

use App\Containers\Currency\Data\Repositories\CurrencyRepository;

final class GetCurrentCurrencyTask
{
    public function run(): string
    {
        return app(CurrencyRepository::class)->getCurrentCurrency();
    }
}
