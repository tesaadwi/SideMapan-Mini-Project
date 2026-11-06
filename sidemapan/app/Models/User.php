<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function umkm(): HasOne
    {
        return $this->hasOne(Umkm::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function aspirations(): HasMany
    {
        return $this->hasMany(Aspiration::class);
    }

    public function aspirasis()
{
    return $this->hasMany(Aspirasi::class);
}
    public function respondedAspirations(): HasMany
    {
        return $this->hasMany(
            Aspiration::class,
            'responded_by'
        );
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUmkm(): bool
    {
        return $this->role === 'umkm';
    }

    public function isPembeli(): bool
    {
        return $this->role === 'pembeli';
    }
    
}