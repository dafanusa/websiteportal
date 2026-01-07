<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_category_id',
        'name',
        'description',
        'price',
        'image_path',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'bool',
            'price' => 'int',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    public function favorite(): HasOne
    {
        return $this->hasOne(MenuFavorite::class);
    }
}
