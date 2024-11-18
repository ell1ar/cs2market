<?php

namespace App\Containers\MarketCSGO\Tasks;

use App\Containers\Settings\Tasks\GetSettingsTask;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

final class BuyForTask
{
    public function run(array $params)
    {
        try {
            $settings = app(GetSettingsTask::class)->run();
            $params['key'] = $settings['api']['MARKET_CSGO_API_KEY'];
            $data = Http::get("https://market.csgo.com/api/v2/buy-for?", $params)->object();
            if (!$data->success) {
                Log::critical($data->error, ['class' => 'BuyForTask']);
                return ['success' => false, 'msg' => $this->parseError($data)];
            }
            return ['success' => true, 'msg' => __('Success')];
        } catch (\Throwable $th) {
            Log::critical($th, ['class' => 'BuyForTask']);
            return ['success' => false, 'msg' => __("Error trade item")];
        }
    }

    private function parseError($data)
    {
        $msg = __("Error in submitting the tradeal request! Please try again in 2 minutes!");

        if (
            strpos($data->error, "Ошибка проверки ссылки, наш бот не сможет забрать или передать вам вещи, проверьте возможность оффлайн трейдов на вашем аккаунте") !== false ||
            strpos($data->error, "Error verifying link. Our bot cannot take or transfer your items. Please check the function of offline trades on your account") !== false
        ) {
            $msg = __("Error verifying the link. Our bot cannot take or transfer your items. Please check the functionality of offline trades on your account. This means you have either a Trade Ban or your inventory is hidden.");
        }

        if (
            strpos($data->error, "Неверная ссылка для обмена") !== false
        ) {
            $msg = __("Invalid trade link. WARNING! You need to do the following: 1. Create a new Trade link in your Steam profile. You can create the link here: http://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url 2. Update it in our bot! Then, you can request the item tradeal again in your profile!");
        }

        if (
            strpos($data->error, "Не найден предмет по указанной цене или ниже") !== false ||
            strpos($data->error, "No item was found at the specified price or lower.") !== false ||
            strpos($data->error, "К сожалению, предложение устарело. Обновите страницу") !== false ||
            strpos($data->error, "Покупка данного предмета по такой цене невозможна") !== false
        ) {
            $msg = __("Error buying and transferring the item to you! The price of this item has increased! You can try to trade the item later or sell it and buy another item in our store!");
        }

        if (
            strpos($data->error, "Недостаточно средств на счету") !== false ||
            strpos($data->error, "Not money") !== false
        ) {
            $msg = __("We do not have enough funds to buy and transfer the skin to you! The balance will be replenished soon! Please try again in 1 hour.");
        }

        if (
            strpos($data->error, "Вам нужно сначала открыть инвентарь в настройках стим профиля.") !== false
        ) {
            $msg = __("You need to first open your inventory in the Steam profile settings.");
        }

        if (
            strpos($data->error, "Вы не можете покупать, так как не приняли слишком много предложений обмена") !== false ||
            strpos($data->error, "Ошибка сервера") !== false
        ) {
            $msg = __("Unfortunately, the item tradeal service is overloaded. Please try again in 1 hour.");
        }

        return $msg;
    }
}
