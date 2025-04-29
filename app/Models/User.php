<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
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

    /**
     * Get the trips associated with the user.
     */
    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * Get the comments associated with the user.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is tripper
     */
    public function isTripper(): bool
    {
        return $this->role === 'tripper';
    }

    /**
     * Check if user is owner
     */
    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    /**
     * Get the owner requests associated with the user.
     */
    public function ownerRequests(): HasMany
    {
        return $this->hasMany(OwnerRequest::class);
    }

    /**
     * Check if user is suspended
     */
    public function isSuspended()
    {
        return $this->status === 'suspended' && $this->suspended_until && $this->suspended_until->isFuture();
    }

    /**
     * Suspend the user
     */
    public function suspend()
    {
        $this->status = 'suspended';
        $this->suspended_until = now()->addHours(24);
        $this->save();
    }

    /**
     * Activate the user
     */
    public function activate()
    {
        $this->status = 'active';
        $this->suspended_until = null;
        $this->save();
    }
}
