<?php

namespace Processton\AccessControll\Traits;

use Processton\AccessControll\AccessControll;
use Processton\AccessControll\Models\Ability;
use Processton\AccessControll\Models\Permission;
use Processton\AccessControll\Models\Role;

Trait HasAbility
{



    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'user_roles',
            'user_id',
            'role_id'
        );
    }

    public function getRoleAttribute()
    {
        return $this->roles()->pluck('name')->join(', ');
    }

    public function abilities()
    {
        return $this->belongsToMany(
            Ability::class,
            'assigned_abilities',
            'user_id',
            'ability_id'
        )->where('allowed', true);
    }

    public function permissions()
    {
        return $this->hasManyThrough(
            'Processton\AccessControll\Models\Permission',
            'Processton\AccessControll\Models\PermissionAbility',
            'ability_id',
            'id',
            'id',
            'permission_id'
        )->where('allowed', true);
    }

    public function hasAbility(string $ability, $entity = null): bool
    {
        if($this->roles->pluck('name')->contains(config('panels.access-controll.data.super_admin'))) {
            return true;
        }

        $query = $this->abilities()->where('name', $ability);

        if($entity) {
            $query->where('model', $entity);
        }

        if($query->exists()) {
            return true;
        }

        Ability::firstOrCreate([
            'name' => $ability,
            'model' => $entity,
        ]);

        return false;
    }

    public function hasRole(string $role): bool
    {

        if ($this->roles->pluck('name')->contains(config('panels.access-controll.data.super_admin'))) {
            return true;
        }
        $query = $this->roles()->where('name', $role);

        if($query->exists()) {
            return true;
        }
        Role::firstOrCreate([
            'name' => $role,
        ]);
        return false;
    }



    public function hasPermission(string $permission, $entity = null): bool
    {

        if ($this->roles->pluck('name')->contains(config('panels.access-controll.data.super_admin'))) {
            return true;
        }
        $query = $this->permissions()->where('name', $permission);

        if($entity) {
            $query->where('model', $entity);
        }

        if($query->exists()) {
            return true;
        }

        Permission::firstOrCreate([
            'name' => $permission,
            'model' => $entity,
        ]);

        return false;

    }
}
