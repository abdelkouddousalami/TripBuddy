<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

interface UserStatus {
    public function isSuspended(): bool;
    public function suspend(): void;
    public function activate(): void;
}

class User extends Authenticatable implements UserStatus
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'role',
        'status',
        'suspended_until'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'suspended_until' => 'datetime',
    ];

    
    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

   
    public function isTripper(): bool
    {
        return $this->role === 'tripper';
    }

  
    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    
    public function ownerRequests(): HasMany
    {
        return $this->hasMany(OwnerRequest::class);
    }

    
    public function isSuspended(): bool
    {
        return $this->status === 'suspended' && 
               $this->suspended_until && 
               Carbon::parse($this->suspended_until)->isFuture();
    }

   
    public function suspend(): void
    {
        $this->status = 'suspended';
        $this->suspended_until = now()->addHours(24);
        $this->save();
    }

    
    public function activate(): void
    {
        $this->status = 'active';
        $this->suspended_until = null;
        $this->save();
    }
}
