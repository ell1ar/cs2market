<?php

namespace App\Containers\Market\UI\CLI\Commands;

use App\Containers\Market\Markets\Skinvend;
use Illuminate\Console\Command;

class UpdateMarketItemsCommand extends Command
{
    protected $signature = 'market-item:update';

    protected $description = 'Market items update';

    public function handle()
    {
        // app(MarketCSGO::class)->updateMarketItems();
        app(Skinvend::class)->updateMarketItems();
    }
}
