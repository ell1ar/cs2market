<?php

namespace App\Containers\ExchangeRate\Data\Seeders;

use App\Ship\Data\BaseSeeder;
use Illuminate\Support\Facades\DB;

class ExchangeRateSeeder extends BaseSeeder
{
    public function getPriority(): int
    {
        return 5;
    }

    public function run()
    {
        $path = 'app/Containers/ExchangeRate/Data/Seeders/exchange_rates.sql';
        DB::unprepared(file_get_contents($path));
    }
}
