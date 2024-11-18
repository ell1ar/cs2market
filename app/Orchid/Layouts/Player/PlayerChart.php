<?php

namespace App\Orchid\Layouts\Player;

use Orchid\Screen\Layouts\Chart;

class PlayerChart extends Chart
{
    protected $type = 'line';
    protected $target = 'players_chart_data';
    protected $colors = [
        '#7feda8',
    ];
}
