<?php

namespace App\Containers\ExchangeRate\UI\CLI\Commands;

use App\Containers\ExchangeRate\Models\ExchangeRate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UpdateExchangeRatesCommand extends Command
{
    protected $signature = 'exchange:update';
    protected $description = 'Exnchange rates update';

    public function handle()
    {
        DB::transaction(function () {
            $data = Http::get("https://www.cbr-xml-daily.ru/daily_json.js")->object();
            if (!isset($data->Valute)) throw new \Exception('Success false');

            foreach ($data->Valute as $char_code => $rate) {
                ExchangeRate::updatable()->updateOrCreate(
                    ['char_code' => $char_code],
                    [
                        'num_code' => $rate->NumCode,
                        'char_code' => $char_code,
                        'nominal' => $rate->Nominal,
                        'name' => $rate->Name,
                        'in_rub' => $rate->Value,
                        'in_rub_previous' => $rate->Previous,
                    ]
                );
            }
        });
    }
}
