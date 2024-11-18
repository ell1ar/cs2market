<?php

namespace App\Containers\Auth\UI\WEB\Controllers;

use App\Containers\Auth\Actions\RegisterPlayerAction;
use App\Containers\Player\Models\PlayerSteamAccount;
use App\Containers\Player\Models\PlayerTelegramAccount;
use App\Containers\Player\Models\PlayerVKAccount;
use App\Ship\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function auth($provider)
    {
        return redirect(Socialite::driver($provider)->redirect()->getTargetUrl());
    }

    public function handle($provider)
    {
        $socialite_info = Socialite::driver($provider)->user();

        $provider_info = match ($provider) {
            'steam' => ['model' => PlayerSteamAccount::class, 'id' => 'steam_id'],
            'telegram' => ['model' => PlayerTelegramAccount::class, 'telegram_id'],
            'vk' => ['model' => PlayerVKAccount::class, 'id' => 'vk_id'],
            default => throw new \Error('Provider not found'),
        };

        if ($player_account = $provider_info['model']::with('player')->firstWhere($provider_info['id'], $socialite_info->id)) {
            $player = $player_account->player;
            $player->fill(['name' => $socialite_info->nickname, 'image' => $socialite_info->avatar])->save();
        } else {
            $player = app(RegisterPlayerAction::class)->run($socialite_info, $provider_info);
        }

        Auth::guard('players')->login($player, true);
        return redirect()->to('/');
    }

    public function logout()
    {
        Auth::guard('players')->logout();
        return redirect()->to('/');
    }
}
