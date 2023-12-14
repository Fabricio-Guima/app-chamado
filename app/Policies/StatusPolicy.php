<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StatusPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('status.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Status $status): bool
    {
         return $user->hasPermissionTo('status.show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
         return $user->hasPermissionTo('status.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Status $status): bool
    {
         return $user->hasPermissionTo('status.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Status $status): bool
    {
         return $user->hasPermissionTo('status.delete');
    }   
}
