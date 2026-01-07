<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuFavorite extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFavoriteFactory> */
    use HasFactory;

    protected $fillable = [
        'menu_item_id',
    ];

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }
}
