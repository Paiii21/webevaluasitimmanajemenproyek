<?php

namespace App\Policies;

use App\Models\Evaluasi;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EvaluasiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Managers and admins can view all evaluations, regular users can view their own
        return $user->isManager() || $user->isAdmin() || $user->isUser();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Evaluasi $evaluasi): bool
    {
        // Managers and admins can view any evaluation, regular users can only view their own
        return $user->isManager() || $user->isAdmin() || $evaluasi->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // All users can create evaluations (subject to business rules in the controller)
        return $user->isManager() || $user->isAdmin() || $user->isUser();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Evaluasi $evaluasi): bool
    {
        // Managers and admins can update any evaluation, regular users can only update their own
        return $user->isManager() || $user->isAdmin() || $evaluasi->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Evaluasi $evaluasi): bool
    {
        // Only managers and admins can delete evaluations
        return $user->isManager() || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Evaluasi $evaluasi): bool
    {
        return $user->isManager() || $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Evaluasi $evaluasi): bool
    {
        return $user->isManager() || $user->isAdmin();
    }
}
