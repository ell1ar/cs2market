<?php

namespace App\Containers\Player\Models;

use App\Containers\Player\Data\Factories\PlayerFactory;
use App\Containers\Shop\Models\ShopPurchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Screen\AsSource;

class Player extends Authenticatable
{
    use HasFactory, Notifiable, AsSource, Filterable, Sortable, Chartable;

    protected $fillable = [
        'name',
        'trade_link',
        'balance',
        'image',
        'is_ban',
        'is_trade',
    ];

    protected $casts = [
        'is_ban' => 'boolean',
        'is_trade' => 'boolean',
    ];

    protected static function newFactory()
    {
        return PlayerFactory::new();
    }

    public function vkAccount()
    {
        return $this->hasOne(PlayerVKAccount::class);
    }

    public function steamAccount()
    {
        return $this->hasOne(PlayerSteamAccount::class);
    }

    public function telegramAccount()
    {
        return $this->hasOne(PlayerTelegramAccount::class);
    }

    public function items()
    {
        return $this->hasMany(PlayerItem::class);
    }

    public function shopPurchases()
    {
        return $this->hasMany(ShopPurchase::class);
    }
}
