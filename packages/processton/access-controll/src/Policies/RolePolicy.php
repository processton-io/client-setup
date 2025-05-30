<?php

namespace Processton\AccessControll\Policies;

use App\Models\User;
use Processton\AccessControll\Models\Role;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->hasAbility('view', Role::class);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $model): bool
    {
        return auth()->user()->hasAbility('view', Role::class);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->hasAbility('create', Role::class);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $model): bool
    {
        return auth()->user()->hasAbility('update', Role::class);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $model): bool
    {
        return auth()->user()->hasAbility('delete', Role::class);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $model): bool
    {
        return auth()->user()->hasAbility('restore', Role::class);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return auth()->user()->hasAbility('force_delete', Role::class);
    }
}
