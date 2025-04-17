<?php

namespace App\Policies;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the trip.
     */
    public function update(User $user, Trip $trip): bool
    {
        return $user->id === $trip->user_id;
    }

    /**
     * Determine whether the user can delete the trip.
     */
    public function delete(User $user, Trip $trip): bool
    {
        return $user->id === $trip->user_id;
    }
}