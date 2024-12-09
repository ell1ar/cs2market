<?php

namespace App\Containers\Market\Models;

use App\Containers\Market\Data\Enums\MarketTradeStatus;
use App\Containers\Market\Models\MarketItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Metrics\Chartable;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Screen\AsSource;

class MarketTrade extends Model
{
    use HasFactory, AsSource, Sortable, Filterable, Chartable;

    protected $table = 'trades';

    protected $fillable = [
        'class_instance',
        'uuid',
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
        'status' => MarketTradeStatus::class,
    ];

    public function item()
    {
        return $this->belongsTo(MarketItem::class, 'class_instance', 'class_instance');
    }

    public function scopeTraded($query)
    {
        return $query->where('status', MarketTradeStatus::Traded);
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', MarketTradeStatus::Proccessing);
    }
}
