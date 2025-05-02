<?php

namespace App\Policies;

use App\Models\OwnerRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OwnerRequestPolicy
{
    use HandlesAuthorization;

    
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

   
    public function view(User $user, OwnerRequest $ownerRequest): bool
    {
        return $user->role === 'admin';
    }

    
    public function approve(User $user, OwnerRequest $ownerRequest): bool
    {
        return $user->role === 'admin';
    }

    
    public function reject(User $user, OwnerRequest $ownerRequest): bool
    {
        return $user->role === 'admin';
    }
}