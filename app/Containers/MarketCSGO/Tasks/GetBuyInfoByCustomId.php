<?php

namespace App\Containers\MarketCSGO\Tasks;

use App\Containers\Settings\Tasks\GetSettingsTask;
use Illuminate\Support\Facades\Http;

final class GetBuyInfoByCustomId
{
    public function run(array|string $custom_ids)
    {
        if (is_string($custom_ids)) $custom_ids = [$custom_ids];

        $settings = app(GetSettingsTask::class)->run();

        return Http::get("https://market.csgo.com/api/v2/get-list-buy-info-by-custom-id?key=" . $settings->data['api']['MARKET_CSGO_API_KEY'] . "&custom_id[]=" . implode('&custom_id[]=', $custom_ids))
            ->throw()
            ->object();
    }
}
