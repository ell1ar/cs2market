<?php

namespace App\Containers\Trade\Models;

use App\Containers\Player\Models\PlayerItem;
use App\Containers\Trade\Data\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Metrics\Chartable;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Screen\AsSource;

class Trade extends Model
{
    use HasFactory, AsSource, Sortable, Filterable, Chartable;

    protected $table = 'trades';

    protected $fillable = [
        'player_item_id',
        'custom_id',
        'paid',
        'status',
        'result'
    ];

    protected $allowedFilters = [
        'status' => Where::class,
    ];

    protected $allowedSorts = [
        'paid',
    ];


    protected $casts = [
        'status' => Status::class,
    ];

    public function playerItem()
    {
        return $this->belongsTo(PlayerItem::class);
    }

    public function scopeTraded($query)
    {
        return $query->where('status', Status::Traded);
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', Status::Proccessing);
    }

    public function scopeFromDefaultPlayer($q)
    {
        return $q->whereHas('playerItem.player', fn($q) => $q->default());
    }
}
