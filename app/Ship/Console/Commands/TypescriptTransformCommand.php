<?php

namespace App\Ship\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TypescriptTransformCommand extends Command
{
    protected $signature = 'ts';

    public function handle()
    {
        return Artisan::call('typescript:transform', [], $this->output);
    }
}
