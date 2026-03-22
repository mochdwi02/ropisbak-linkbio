<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BioLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'category',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function clicks(): HasMany
    {
        return $this->hasMany(LinkClick::class);
    }
}
