<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'umkm_id',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'status',
        'sold',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'sold' => 'integer',
    ];

    /**
     * Produk milik UMKM.
     */
    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class);
    }

    /**
     * Produk termasuk dalam kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Item pesanan yang menggunakan produk ini.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}