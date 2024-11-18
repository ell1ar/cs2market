<?php

namespace App\Containers\Player\Actions;

use App\Containers\ExchangeRate\Models\ExchangeRate;
use App\Containers\Item\Tasks\GetItemByMarketHashNameTask;
use App\Containers\MarketCSGO\Tasks\BuyForTask;
use App\Containers\Player\Data\Enums\PlayerItemStatus;
use App\Containers\Player\Tasks\GetAuthPlayerTask;
use App\Containers\Trade\Data\Enums\Status as TradeStatus;
use App\Ship\Exceptions\BaseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class PlayerItemTradeAction
{
    public function run(string $uniqid)
    {
        $trade = DB::transaction(function () use ($uniqid) {
            $player = app(GetAuthPlayerTask::class)->run(is_locked: true);
            if (!$player->trade_link) throw new BaseException(__('Trade link not specified'));

            $player_item = $player->items()->ready()->where('uniqid', $uniqid)->lockForUpdate()->first();
            if (!$player_item) throw new BaseException(__('Item not found'));
            $player_item->fill(['status' => PlayerItemStatus::TradeWait])->save();

            if ($player->is_trade_limit) {
                if ($player_item->price > $player->trade_limit) throw new BaseException(__('Trades are not available to you'));
                $player->trade_limit -= $player_item->price;
                $player->save();
            }

            $item = app(GetItemByMarketHashNameTask::class)->run($player_item->market_hash_name);
            if (!$item) throw new BaseException(__('This item is temporarily unavailable for tradeal'));
            if ($item->price_market > $player_item->price)  throw new BaseException(__('The price of this item has changed a lot! Try waiting or selling and buying a new item!'));

            $params = ['status' => TradeStatus::Wait, 'result' => __('Wait')];
            $trade = $player_item->trade()->first();
            if ($trade) $trade->fill($params)->save();
            if (!$trade) $trade = $player_item->trade()->create(array_merge($params, ['custom_id' => Str::random(50)]));
            return $trade;
        });

        $exchange_rate_usd = ExchangeRate::USD()->first();
        $result = app(BuyForTask::class)->run([
            'hash_name' => $trade->playerItem->market_hash_name,
            'price' => $trade->playerItem->price * 100 * ($exchange_rate_usd->in_rub / $exchange_rate_usd->nominal),
            'custom_id' => $trade->custom_id,
            'partner' => $trade->playerItem->player->tradeLinkPartner,
            'token' => $trade->playerItem->player->tradeLinkToken
        ]);

        if (!$result['success']) {
            DB::transaction(function () use ($result, $trade) {
                $trade->playerItem->fill(['status' => PlayerItemStatus::Ready])->save();
                $trade->fill(['status' => TradeStatus::Fail, 'result' => $result['msg']])->save();
            });
            throw new BaseException($result['msg']);
        }

        if ($result['success']) {
            DB::transaction(function () use ($trade) {
                $trade->playerItem->fill(['status' => PlayerItemStatus::TradeProccess])->save();
                $trade->fill(['status' => TradeStatus::Proccessing, 'result' => __('Proccessing')])->save();
            });
        }
    }
}
