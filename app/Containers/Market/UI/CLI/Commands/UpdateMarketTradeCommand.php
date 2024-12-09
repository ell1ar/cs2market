<?php

namespace App\Containers\MarketCSGO\UI\CLI\Commands;

use App\Containers\ExchangeRate\Models\ExchangeRate;
use App\Containers\MarketCSGO\Data\Enums\BuyForStatus;
use App\Containers\MarketCSGO\Tasks\GetBuyInfoByCustomId;
use App\Containers\Player\Data\Enums\PlayerMarketItemStatus;
use App\Containers\Market\Data\Enums\Status as TradeStatus;
use App\Containers\Market\Models\Trade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateMarketTradeCommand extends Command
{
    protected $signature = 'trade:check';

    protected $description = 'Check trade';

    public function handle()
    {
        // $custom_ids = Trade::processing()->pluck('custom_id')->toArray();
        // if (count($custom_ids) == 0)
        //     return;

        // $result = app(GetBuyInfoByCustomId::class)->run($custom_ids);
        // if (!isset($result->data)) throw new \Exception($result->error ?? 'Unknown error');

        // foreach ($result->data as $custom_id => $market_item) {
        //     $trade = Trade::firstWhere('custom_id', $custom_id);

        //     if ($market_item->stage == BuyForStatus::SUCCESS->value) {
        //         DB::transaction(function () use ($trade, $market_item) {
        //             $exchange_rate_usd = ExchangeRate::USD()->first();
        //             $trade->fill([
        //                 'status' => TradeStatus::Traded,
        //                 'result' => __('Traded'),
        //                 'paid' => $market_item->paid / ($exchange_rate_usd->in_rub / $exchange_rate_usd->nominal),
        //             ])->save();
        //             $trade->playerItem->fill(['status' => PlayerMarketItemStatus::Trade])->save();
        //         });
        //     }

        //     if ($market_item->stage == BuyForStatus::ERROR->value) {
        //         DB::transaction(function () use ($trade) {
        //             $trade->fill(['status' => TradeStatus::Fail, 'result' => __('Fail')])->save();
        //             $trade->playerItem->fill(['status' => PlayerMarketItemStatus::Ready])->save();
        //         });
        //     }

        //     if ($market_item->stage == BuyForStatus::WAITING->value) {
        //         $trade->fill(['result' => __('Processing')])->save();
        //     }
        // }
    }
}
