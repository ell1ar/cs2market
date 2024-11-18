<?php

namespace App\Containers\Shop\UI\WEB\Controllers;

use App\Containers\Shop\Actions\BuyAction;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function buy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        app(BuyAction::class)->run($request->price);
        return redirect()->back()->withSuccess(__('Item bought'));
    }
}
