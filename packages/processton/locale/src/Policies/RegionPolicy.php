<?php

namespace Processton\Locale\Policies;

use App\Models\User;
use Processton\Locale\Models\Region;

class RegionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->hasAbility('view', Region::class);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $model): bool
    {
        return auth()->user()->hasAbility('view', Region::class);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->hasAbility('create', Region::class);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Region $model): bool
    {
        return auth()->user()->hasAbility('update', Region::class);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Region $model): bool
    {
        return auth()->user()->hasAbility('delete', Region::class);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Region $model): bool
    {
        return auth()->user()->hasAbility('restore', Region::class);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Region $model): bool
    {
        return auth()->user()->hasAbility('force_delete', Region::class);
    }
}
