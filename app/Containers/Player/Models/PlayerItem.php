<?php

namespace App\Containers\Player\Models;

use App\Containers\Item\Models\Item;
use App\Containers\Player\Data\Factories\PlayerItemFactory;
use App\Containers\Player\Data\Enums\PlayerItemStatus;
use App\Containers\Trade\Models\Trade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PlayerItem extends Model
{
    use HasFactory;

    protected $table = 'player_items';

    protected $fillable = [
        'player_id',
        'market_hash_name',
        'dropable_type',
        'dropable_id',
        'status',
        'price',
        'uniqid',
    ];

    protected static function newFactory()
    {
        return PlayerItemFactory::new();
    }

    public function scopeReady($query)
    {
        return $query->where('status', PlayerItemStatus::Ready);
    }

    public function dropable(): MorphTo
    {
        return $this->morphTo();
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function trade()
    {
        return $this->hasOne(Trade::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'market_hash_name', 'market_hash_name');
    }
}
