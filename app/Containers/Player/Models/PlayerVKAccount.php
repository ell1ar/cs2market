<?php

namespace App\Containers\Player\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerVKAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'vk_id',
        'nickname',
        'avatar_url',
    ];

    /**
     * Связь с моделью Player
     */
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
