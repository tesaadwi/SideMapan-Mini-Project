<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspiration extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'subject',
        'content',
        'status',
        'response',
        'responded_by',
        'responded_at',
    ];

    protected function casts(): array
    {
        return [
            'responded_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function responder(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'responded_by'
        );
    }
}
