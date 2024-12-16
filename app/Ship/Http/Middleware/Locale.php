<?php

namespace App\Ship\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->getPreferredLanguage(array_keys(config('app.available_locales')));
        if ($locale) app()->setLocale($locale);
        return $next($request);
    }
}
