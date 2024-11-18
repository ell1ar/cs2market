<?php

namespace App\Containers\Site\Models;

use App\Containers\Site\Models\Site;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteCategory extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'position',
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function sites()
    {
        return $this->hasMany(Site::class, 'category_id')->orderBy('position');
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', 1);
    }
}
