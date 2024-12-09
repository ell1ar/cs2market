<?php

namespace App\Containers\Development\UI\WEB\Controllers;

use App\Containers\Market\Markets\MarketCSGO;
use App\Containers\Player\Models\Player;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DevController extends Controller
{
    public function dev()
    {

    }

    public function fakeAuth(int $id)
    {
        Auth::guard('players')->login(Player::findOrFail($id), true);
        return redirect('/');
    }
}
