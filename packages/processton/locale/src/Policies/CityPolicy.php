<?php

namespace Processton\Locale\Policies;

use App\Models\User;
use Processton\Locale\Models\City;

class CityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->hasAbility('view', City::class);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $model): bool
    {
        return auth()->user()->hasAbility('view', City::class);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->hasAbility('create', City::class);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, City $model): bool
    {
        return auth()->user()->hasAbility('update', City::class);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, City $model): bool
    {
        return auth()->user()->hasAbility('delete', City::class);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, City $model): bool
    {
        return auth()->user()->hasAbility('restore', City::class);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, City $model): bool
    {
        return auth()->user()->hasAbility('force_delete', City::class);
    }
}
