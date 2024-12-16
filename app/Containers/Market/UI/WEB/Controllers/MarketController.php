<?php

namespace App\Containers\Market\UI\WEB\Controllers;

use App\Containers\Market\Actions\SellAction;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function sell(Request $request)
    {
        $validated = $request->validate([
            'instance_ids' => 'required|array',
        ]);

        $data = app(SellAction::class)->run($validated);
    }
}
