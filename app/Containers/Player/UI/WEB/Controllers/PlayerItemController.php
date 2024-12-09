<?php

namespace App\Containers\Player\UI\WEB\Controllers;

use App\Containers\Player\Actions\PlayerMarketItemSellAction;
use App\Containers\Player\Actions\PlayerMarketItemSellAllAction;
use App\Containers\Player\Actions\PlayerMarketItemTradeAction;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayerMarketItemController extends Controller
{
    public function sell(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uniqid' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        app(PlayerMarketItemSellAction::class)->run($request->uniqid);
        return redirect()->back()->withSuccess(__('Item sold'));
    }

    public function sellAll()
    {
        app(PlayerMarketItemSellAllAction::class)->run();
    }

    public function trade(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uniqid' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        app(PlayerMarketItemTradeAction::class)->run($request->uniqid);
    }
}
