<?php

namespace Processton\Locale\Policies;

use App\Models\User;
use Processton\Locale\Models\Zone;

class ZonePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->hasAbility('view', Zone::class);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $model): bool
    {
        return auth()->user()->hasAbility('view', Zone::class);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->hasAbility('create', Zone::class);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Zone $model): bool
    {
        return auth()->user()->hasAbility('update', Zone::class);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Zone $model): bool
    {
        return auth()->user()->hasAbility('delete', Zone::class);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Zone $model): bool
    {
        return auth()->user()->hasAbility('restore', Zone::class);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Zone $model): bool
    {
        return auth()->user()->hasAbility('force_delete', Zone::class);
    }
}
