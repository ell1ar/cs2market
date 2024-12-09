<?php

namespace App\Containers\Currency\Middleware;

use Closure;
use Illuminate\Http\Request;

class Currency
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
