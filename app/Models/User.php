<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'role',
        'status',
        'suspended_until'
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'suspended_until' => 'datetime',
    ];

    
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

   
    public function isTripper()
    {
        return $this->role === 'tripper';
    }

  
    public function isOwner()
    {
        return $this->role === 'owner';
    }

    
    public function ownerRequests()
    {
        return $this->hasMany(OwnerRequest::class);
    }

    
    public function isSuspended()
    {
        return $this->status === 'suspended' && 
               $this->suspended_until && 
               Carbon::parse($this->suspended_until)->isFuture();
    }

   
    public function suspend()
    {
    
            $this->status = 'suspended';
            $this->suspended_until = now()->addHours(24);
            $this->save();
        
        
    }

    
    public function activate()
    {
        $this->status = 'active';
        $this->suspended_until = null;
        $this->save();
    }
}
