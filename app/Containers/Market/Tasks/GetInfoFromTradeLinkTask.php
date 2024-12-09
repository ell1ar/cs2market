<?php

namespace App\Containers\Market\Tasks;

use Illuminate\Support\Facades\Http;

final class GetInfoFromTradeLinkTask
{
    public function run(string $trade_link)
    {
        $row = strpos($trade_link, "partner=");
        $str = substr($trade_link, $row + 8);
        $row = strpos($str, "&token=");
        $partner = substr($str, 0, $row);

        $row = strpos($trade_link, "&token=");
        $token = substr($trade_link, $row + 7);

        return compact('partner', 'token');
    }
}
