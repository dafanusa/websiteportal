<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyItem extends Model
{
    /** @use HasFactory<\Database\Factories\WhyItemFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon_class',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'int',
            'is_active' => 'bool',
        ];
    }
}
