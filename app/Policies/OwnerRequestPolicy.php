<?php

namespace App\Policies;

use App\Models\OwnerRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OwnerRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OwnerRequest $ownerRequest): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can approve the owner request.
     */
    public function approve(User $user, OwnerRequest $ownerRequest): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can reject the owner request.
     */
    public function reject(User $user, OwnerRequest $ownerRequest): bool
    {
        return $user->role === 'admin';
    }
}