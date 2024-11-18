<?php

namespace App\Containers\ExchangeRate\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class ExchangeRate extends Model
{
    use HasFactory, AsSource;

    protected $table = 'exchange_rates';

    protected $fillable = [
        'num_code',
        'char_code',
        'nominal',
        'name',
        'in_rub',
        'in_rub_previous',
        'is_updatable'
    ];

    protected $casts = [
        'is_updatable' => 'boolean'
    ];

    public function scopeUpdatable($query)
    {
        return $query->where('is_updatable', true);
    }

    public function scopeUSD($query)
    {
        return $query->where('char_code', 'USD');
    }

    public function scopeCurrency($query, $currency)
    {
        return $query->where('char_code', $currency);
    }
}
