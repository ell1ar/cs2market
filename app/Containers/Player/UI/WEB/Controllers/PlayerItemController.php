<?php

namespace App\Containers\Player\UI\WEB\Controllers;

use App\Containers\Player\Actions\PlayerItemSellAction;
use App\Containers\Player\Actions\PlayerItemSellAllAction;
use App\Containers\Player\Actions\PlayerItemTradeAction;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayerItemController extends Controller
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

        app(PlayerItemSellAction::class)->run($request->uniqid);
        return redirect()->back()->withSuccess(__('Item sold'));
    }

    public function sellAll()
    {
        app(PlayerItemSellAllAction::class)->run();
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

        app(PlayerItemTradeAction::class)->run($request->uniqid);
    }
}
