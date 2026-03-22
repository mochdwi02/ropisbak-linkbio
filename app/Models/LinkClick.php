<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'bio_link_id',
        'session_id',
        'ip_address',
        'user_agent',
    ];

    public function bioLink(): BelongsTo
    {
        return $this->belongsTo(BioLink::class);
    }
}
