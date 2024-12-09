<?php

namespace App\Containers\Market\UI\WEB\Controllers;

use App\Ship\Http\Controllers\Controller;
use Inertia\Inertia;

class SearchMarketItemsController extends Controller
{
    public function run()
    {
        return Inertia::render('Index', []);
    }
}
