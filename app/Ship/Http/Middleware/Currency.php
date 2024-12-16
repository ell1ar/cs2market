<?php

namespace App\Ship\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Currency
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->getPreferredLanguage(array_keys(config('app.available_currencies')));
        if ($locale) app()->setLocale($locale);
        return $next($request);
    }
}
