<?php

namespace App\Policies;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApartmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->admin_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Apartment $apartment): bool
    {
        // Check if user has a pending subscription payment
        if ($user->subscription && $user->subscription->payment_status === 'pending') {
            return false;
        }
        
        return $user->id === $apartment->admin_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Apartment $apartment): bool
    {
        // Check if user has a pending subscription payment
        if ($user->subscription && $user->subscription->payment_status === 'pending') {
            return false;
        }
        
        return $user->id === $apartment->admin_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->admin_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->admin_id;
    }
}
