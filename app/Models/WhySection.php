<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhySection extends Model
{
    /** @use HasFactory<\Database\Factories\WhySectionFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'button_label',
        'button_link',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'bool',
        ];
    }
}
