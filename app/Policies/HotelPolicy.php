<?php

namespace App\Policies;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HotelPolicy
{
    
    public function viewAny(User $user): bool
    {
        return true;
    }

    
    public function view(User $user, Hotel $hotel): bool
    {
        return true;
    }

   
    public function create(User $user): bool
    {
        return $user->isOwner();
    }

    
    public function update(User $user, Hotel $hotel): bool
    {
        return $user->id === $hotel->user_id;
    }

    
    public function delete(User $user, Hotel $hotel): bool
    {
        return $user->id === $hotel->user_id;
    }

    

    
    public function contact(User $user, Hotel $hotel): bool
    {
        return true; 
    }
}
