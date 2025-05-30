<?php

namespace Processton\AccessControll\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Processton\AccessControll\AccessControll;

class AccessControllSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $administratorModels = config('panels.access-controll.data.admin_models', []);

        $ignoreModels = config('panels.access-controll.data.ignore_models', []);

        $anyModels = config('panels.access-controll.data.any_models', []);

        $permissions = [];

        $adminPermissions = [];

        $superAdminPermissions = [];

        foreach(config('panels.access-controll.data.panels') as $row) {

            foreach($row['models'] as $key => $model) {

                if (in_array($model, $ignoreModels)) {
                    continue;
                }

                if (in_array($model, $administratorModels)) {

                    $abilities = [
                        AccessControll::addAbility('view', $model),
                    ];

                    $permissions[] = AccessControll::addPermission(
                        $key,
                        'Setup',
                        'Observation',
                        'Allowed users can view the ' . $key . ' resource.'
                    );

                    $abilities[] = AccessControll::addAbility('create', $model);
                    $abilities[] = AccessControll::addAbility('update', $model);

                    $adminPermissions[] = AccessControll::addPermission(
                        $key . ' Management',
                        'Setup',
                        'Management',
                        'Allowed users can create and update the ' . $key . ' resource.'
                    );

                    AccessControll::assignAbilitiesToPermission(
                        $adminPermissions[count($adminPermissions) - 1],
                        $abilities
                    );

                    $abilities[] = AccessControll::addAbility('delete', $model);
                    $abilities[] = AccessControll::addAbility('restore', $model);
                    $abilities[] = AccessControll::addAbility('force_delete', $model);



                    $superAdminPermissions[] = AccessControll::addPermission(
                        $key . ' Administration',
                        'Setup',
                        'Administration',
                        'Allowed users can create, update, delete and restore the ' . $key . ' resource.'
                    );

                    AccessControll::assignAbilitiesToPermission(
                        $superAdminPermissions[count($superAdminPermissions) - 1],
                        $abilities
                    );

                    continue;
                }

                if (!in_array($model, $ignoreModels) && !in_array($model, $administratorModels)) {

                    $abilities = [];

                    $abilities[] = AccessControll::addAbility('view', $model);

                    if (in_array($model, $anyModels)) {
                        $abilities[] = AccessControll::addAbility('view_any', $model);
                    }

                    $permissions[] = AccessControll::addPermission(
                        $key . ' Observation',
                        $row['name'],
                        $key,
                        'Allowed users can view the ' . $key . ' resource.'
                    );

                    AccessControll::assignAbilitiesToPermission(
                        $permissions[count($permissions) - 1],
                        $abilities
                    );

                    $abilities[] = AccessControll::addAbility('create', $model);
                    $abilities[] = AccessControll::addAbility('update', $model);

                    if(in_array($model, $anyModels)) {
                        $abilities[] = AccessControll::addAbility('update_any', $model);
                    }

                    $permissions[] = AccessControll::addPermission(
                        $key . ' Management',
                        $row['name'],
                        $key,
                        'Allowed users can create and update the ' . $key . ' resource.'
                    );

                    AccessControll::assignAbilitiesToPermission(
                        $permissions[count($permissions) - 1],
                        $abilities
                    );

                    $abilities[] = AccessControll::addAbility('delete', $model);
                    $abilities[] = AccessControll::addAbility('restore', $model);
                    $abilities[] = AccessControll::addAbility('force_delete', $model);


                    $adminPermissions[] = AccessControll::addPermission(
                        $key . ' Administration',
                        $row['name'],
                        $key,
                        'Allowed users can create, update, delete and restore the ' . $key . ' resource.'
                    );

                    AccessControll::assignAbilitiesToPermission(
                        $adminPermissions[count($adminPermissions) - 1],
                        $abilities
                    );
                }
            }
        }


        $superAdminRole = AccessControll::addRole('Super Admin', 'web');
        $developerRole = AccessControll::addRole('Developer', 'web');
        $adminRole = AccessControll::addRole('Admin', 'web');
        $internalUserRole = AccessControll::addRole('Internal User', 'web');
        $userRole = AccessControll::addRole('Community User', 'web');

        foreach($permissions as $permission) {
            AccessControll::assignPermissionToRoleModel($superAdminRole, $permission);
            AccessControll::assignPermissionToRoleModel($adminRole, $permission);
            AccessControll::assignPermissionToRoleModel($developerRole, $permission);
            AccessControll::assignPermissionToRoleModel($internalUserRole, $permission);
        }

        foreach($adminPermissions as $permission) {
            AccessControll::assignPermissionToRoleModel($superAdminRole, $permission);
            AccessControll::assignPermissionToRoleModel($adminRole, $permission);
            AccessControll::assignPermissionToRoleModel($developerRole, $permission);
        }

        foreach($superAdminPermissions as $permission) {
            AccessControll::assignPermissionToRoleModel($superAdminRole, $permission);
            AccessControll::assignPermissionToRoleModel($developerRole, $permission);
        }
        // // $superAdminRole->givePermissionTo(Permission::whereGuardName('web')->get());

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);

        AccessControll::assignRoleToUser($superAdmin, $superAdminRole);

        AccessControll::syncUserAbilities($superAdmin);

        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        AccessControll::assignRoleToUser($adminUser, $adminRole);




    }

}
