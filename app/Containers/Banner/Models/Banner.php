<?php

namespace App\Containers\Banner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Banner extends Model
{
    use HasFactory, AsSource;

    const TOP_TYPE = 'top';
    const LEFT_TYPE = 'left';
    const RIGHT_TYPE = 'right';
    const MIDDLE_TYPE = 'middle';

    protected $table = 'banners';

    protected $fillable = [
        'image',
        'link',
        'type',
        'position',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getEditPositionAttribute()
    {
        return $this->type . '_' . $this->position;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeTop($query)
    {
        return $query->where('type', self::TOP_TYPE);
    }

    public function scopeLeft($query)
    {
        return $query->where('type', self::LEFT_TYPE);
    }

    public function scopeRight($query)
    {
        return $query->where('type', self::RIGHT_TYPE);
    }
}
