<?php

namespace App\Containers\Currency\Tasks;

use App\Containers\Currency\Data\Repositories\CurrencyRepository;
use App\Containers\ExchangeRate\Models\ExchangeRate;

final class GetCurrencyValueTask
{
    public function run($value): float|int
    {
        $currency = app(CurrencyRepository::class)->getCurrentCurrency();

        if ($currency === 'USD') {
            return $value;
        }

        if ($currency === 'RUB') {
            $exchange_usd = ExchangeRate::USD()->first();
            return round($value * $exchange_usd->in_rub / $exchange_usd->nominal, 2);
        }

        return $value;
    }
}
