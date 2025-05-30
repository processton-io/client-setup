<?php

declare(strict_types=1);

namespace Processton\AccessControll;

use App\Models\User;
use Processton\AccessControll\Models\Ability;
use Processton\AccessControll\Models\AssignedAbility;
use Processton\AccessControll\Models\AssignedPersmission;
use Processton\AccessControll\Models\Permission;
use Processton\AccessControll\Models\PermissionAbility;
use Processton\AccessControll\Models\Role;
use Processton\AccessControll\Models\UserRole;

class AccessControll
{
    public static function addRole(string $name, string $guard = 'web'): bool | Role
    {
        if ($name != '') {
            return Role::firstOrCreate([
                'name' => $name,
                'guard_name' => $guard,
            ]);
        }

        return false;
    }

    public static function assignRoleToUserByName(User $user, string $roleName): bool | UserRole
    {
        $role = Role::where('name', $roleName)->first();

        if ($role && $user) {
            return self::assignRoleToUser($user, $role->name);
        }

        return false;
    }

    public static function assignRoleToUser(User $user, Role $role): bool | UserRole
    {
        if ($role && $user) {
            return UserRole::firstOrCreate([
                'user_id' => $user->id,
                'role_id' => $role->id,
            ]);
        }

        return false;
    }

    public static function addPermission(string $name, string $group = '', string $subGroup = '', string $description = ''): Permission
    {
        return Permission::firstOrCreate([
            'name' => $name,
            'group' => $group,
            'sub_group' => $subGroup,
            'description' => $description,
        ]);
    }

    public static function assignPermissionToRole(string $roleName, string $permissionName): bool | AssignedPersmission
    {
        $role = Role::where('name', $roleName)->first();
        $permission = Permission::where('name', $permissionName)->first();

        if ($role && $permission) {
            return self::assignPermissionToRoleModel($role, $permission);
        }

        return false;
    }

    public static function assignPermissionToRoleModel(Role $role, Permission $permission): bool | AssignedPersmission
    {

        if ($role && $permission) {
            return AssignedPersmission::create([
                'role_id' => $role->id,
                'permission_id' => $permission->id,
            ]);
        }

        return false;
    }

    public static function addAbility(string $name, string $model = null): bool | Ability
    {
        if($name != ''){

            return Ability::firstOrCreate([
                'name' => $name,
                'model' => $model,
            ]);
        }

        return false;

    }

    public static function assignAbilitiesToPermission(string | Permission $permission, array $abilities): bool | PermissionAbility
    {
        if(is_string($permission)){
            $permission = Permission::where('name', $permission)->first();
        }

        if ($permission) {
            foreach ($abilities as $ability) {
                if(is_string($ability)){
                    $ability = Ability::where('name', $ability)->first();
                }
                self::assignAbilityToPermission($permission, $ability);
            }
            return true;
        }

        return false;
    }

    public static function assignAbilityToPermission(string | Permission $permission, string | Ability $ability): bool | PermissionAbility
    {
        if(is_string($permission)){
            $permission = Permission::where('name', $permission)->first();
        }
        if(is_string($ability)){
            $ability = Ability::where('name', $ability)->first();
        }

        if ($permission && $ability) {
            return PermissionAbility::firstOrCreate([
                'permission_id' => $permission->id,
                'ability_id' => $ability->id,
            ]);
        }

        return false;
    }

    public static function syncUserAbilities(User $user) : void
    {
        AssignedAbility::where('user_id', $user->id)->delete();

        $roles = UserRole::where('user_id', $user->id)->get();

        $permissions = AssignedPersmission::whereIn('role_id', $roles->pluck('role_id'))->get();

        $permissionAbilities = PermissionAbility::whereIn('permission_id', $permissions->pluck('permission_id'))->groupBy('id')->get();

        $abilities = Ability::whereIn('id', $permissionAbilities->pluck('ability_id'))->get();

        foreach($abilities as $ability){
            
            AssignedAbility::firstOrCreate([
                'user_id' => $user->id,
                'ability_id' => $ability->id,
                'allowed' => true,
            ]);
            
        }
    }

    public static function hasAbility(User $user, string $ability, $entity = null): bool
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }

        $assignedAbility = AssignedAbility::where('user_id', $user->id)
            ->where('ability_id', Ability::where('name', $ability)->first()->id)
            ->first();

        if ($assignedAbility) {
            return true;
        }

        return false;
    }



}
