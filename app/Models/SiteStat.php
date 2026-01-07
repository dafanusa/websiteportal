<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteStat extends Model
{
    /** @use HasFactory<\Database\Factories\SiteStatFactory> */
    use HasFactory;

    protected $fillable = [
        'key',
        'label',
        'value',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'int',
            'sort_order' => 'int',
        ];
    }
}
