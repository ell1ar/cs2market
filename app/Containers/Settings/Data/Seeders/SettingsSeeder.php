<?php

namespace App\Containers\Settings\Data\Seeders;

use App\Containers\Settings\Models\Settings;
use App\Ship\Data\BaseSeeder;

class SettingsSeeder extends BaseSeeder
{
    public function getPriority(): int
    {
        return 1;
    }

    public function run()
    {
        Settings::create([
            'data' => [
                'api' => [
                    'MARKET_API_KEY' => '',
                ],
                'meta' => [
                    'head' => null,
                    'logo' => null,
                    'title' => 'Affiliate',
                    'favicon' => null,
                    'scripts' => null,
                    'keywords' => 'cs2',
                ],
                'wheel' => [
                    'is_active' => 0,
                    'limit_max_price' => 0.1,
                ],
                'social' => [
                    'is_vk_auth' => false,
                    'VK_CLIENT_ID' => null,
                    'is_steam_auth' => true,
                    'VK_CLIENT_SECRET' => null,
                    'is_telegram_auth' => false,
                    'TELEGRAM_BOT_TOKEN' => null,
                    'STEAM_CLIENT_SECRET' => '',
                ],
                'wheel_promocode' => []
            ],
        ]);
    }
}
