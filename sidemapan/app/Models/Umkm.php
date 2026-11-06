<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Umkm extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'address',
        'phone',
        'logo',
        'status',
        'rejection_reason',
    ];

    /**
     * Relasi UMKM dengan User/Pemilik
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi UMKM dengan Produk
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}