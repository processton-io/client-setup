<?php

namespace Processton\Locale\Policies;

use App\Models\User;
use Processton\Locale\Models\Currency;

class CurrencyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->hasAbility('view', Currency::class);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $model): bool
    {
        return auth()->user()->hasAbility('view', Currency::class);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->hasAbility('create', Currency::class);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Currency $model): bool
    {
        return auth()->user()->hasAbility('update', Currency::class);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Currency $model): bool
    {
        return auth()->user()->hasAbility('delete', Currency::class);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Currency $model): bool
    {
        return auth()->user()->hasAbility('restore', Currency::class);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Currency $model): bool
    {
        return auth()->user()->hasAbility('force_delete', Currency::class);
    }
}
