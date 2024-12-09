<?php

namespace App\Orchid\Screens\Statistics;

use App\Containers\Player\Models\Player;
use App\Containers\Player\Models\PlayerMarketItem;
use App\Containers\Market\Models\Trade;
use App\Orchid\Layouts\Player\PlayerChart;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class StatisticsScreen extends Screen
{
    public function query(): array
    {
        $count_players = Player::count();
        $sum_players_balance = round(Player::sum('balance'), 2);
        // $avg_trade_player = $count_players > 0 ? round($sum_trades / $count_players, 2) : 0;

        $groups_statistics_cards[] = [
            // [
            //     'title' => __('Total spent'),
            //     'value' => $sum_trades . " USD",
            // ],
            // [
            //     'title' => __('AVG spent (1 player)'),
            //     'value' => $avg_trade_player . ' USD',
            // ],
            [
                'title' => __('Count players'),
                'value' => $count_players,
            ],
        ];

        // $groups_statistics_cards[] = [
        //     [
        //         'title' => 'Player\'s balance',
        //         'value' => $sum_players_balance + $sum_players_items . " USD",
        //     ],
        // ];

        return [
            'groups_statistics_cards' => $groups_statistics_cards,
            // 'income_outcome_chart_data' => [
            //     Trade::traded()->sumByDays('paid')->toChart(__('Paid')),
            // ],
            'players_chart_data' => [
                Player::countByDays()->toChart('Count')
            ],
        ];
    }

    public function name(): ?string
    {
        return __('Statistics');
    }

    public function layout(): array
    {
        return [
            Layout::view('admin::orchid.statistics.index'),
            PlayerChart::make('players_chart_data', __('New players')),
        ];
    }
}
