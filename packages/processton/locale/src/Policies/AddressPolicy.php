<?php

namespace Processton\Locale\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Processton\Locale\Models\Address;

class AddressPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->hasAbility('view', Address::class);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Address $model): bool
    {
        return auth()->user()->hasAbility('view', Address::class);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->hasAbility('create', Address::class);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Address $model): bool
    {
        return auth()->user()->hasAbility('update', Address::class);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Address $model): bool
    {
        return auth()->user()->hasAbility('delete', Address::class);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Address $model): bool
    {
        return auth()->user()->hasAbility('restore', Address::class);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Address $model): bool
    {
        return auth()->user()->hasAbility('force_delete', Address::class);
    }
}
