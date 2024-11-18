<?php

namespace App\Containers\Player\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerTelegramAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'telegram_id',
        'username',
    ];

    /**
     * Связь с моделью Player
     */
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
