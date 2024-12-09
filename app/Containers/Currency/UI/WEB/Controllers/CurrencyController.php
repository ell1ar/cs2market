<?php

namespace App\Containers\Currency\UI\WEB\Controllers;

use App\Containers\Player\Tasks\SetCurrentCurrencyTask;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function setCurrency(Request $request)
    {
        $request->validate([
            'currency' => 'required|string|size:3',
        ]);

        if (!in_array($request->currency, config('currency.avaiable_list'))) {
            return redirect()->back()->with(['error' => __('Currency not found')]);
        }

        app(SetCurrentCurrencyTask::class)->run($request->currency);
        return redirect()->back();
    }
}
