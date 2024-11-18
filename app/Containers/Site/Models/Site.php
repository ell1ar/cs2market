<?php

namespace App\Containers\Site\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Site extends Model
{
    use HasFactory, AsSource;

    protected $casts = [
        'is_new' => 'boolean',
        'is_hot' => 'boolean',
        'is_vpn' => 'boolean',
        'is_vip' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'position',
        'price',
        'link',
        'image',
        'promo',
        'category_id',
        'instruction',
        'is_new',
        'is_hot',
        'is_vpn',
        'is_vip',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(SiteCategory::class, 'category_id');
    }

    public function scopeActive($q)
    {
        return $q->where('show', 1);
    }
}
