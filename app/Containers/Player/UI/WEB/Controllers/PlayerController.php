<?php

namespace App\Containers\Player\UI\WEB\Controllers;

use App\Containers\Player\Actions\SetTradeLinkAction;
use App\Containers\Player\Rules\TradeLinkRule;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    public function info(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tradeLink' => ['required', 'string', new TradeLinkRule()],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        app(SetTradeLinkAction::class)->run($request->get('tradeLink'));

        return redirect()->back()->withSuccess(__('Trade link set'));
    }
}
