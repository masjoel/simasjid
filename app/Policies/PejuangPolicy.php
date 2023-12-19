<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PejuangPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $rules = ['deputi', 'bakorsi', 'superadmin', 'admin'];
        if ($user->username === 'masmin' || in_array($user->roles, $rules)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Member $pejuang): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $rules = ['deputi', 'superadmin'];
        if ($user->username === 'masmin' || in_array($user->roles, $rules)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Member $pejuang): bool
    {
        $rules = ['deputi', 'superadmin'];
        if ($user->username === 'masmin' || in_array($user->roles, $rules)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Member $pejuang): bool
    {
        $rules = ['deputi', 'superadmin'];
        if ($user->username === 'masmin' || in_array($user->roles, $rules)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Member $pejuang): bool
    {
        $rules = ['deputi', 'superadmin'];
        if ($user->username === 'masmin' || in_array($user->roles, $rules)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Member $pejuang): bool
    {
        $rules = ['deputi', 'superadmin'];
        if ($user->username === 'masmin' || in_array($user->roles, $rules)) {
            return true;
        }
        return false;
    }
}
