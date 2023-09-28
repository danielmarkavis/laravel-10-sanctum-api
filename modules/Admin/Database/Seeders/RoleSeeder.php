<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Modules\Admin\Services\PermissionService;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $adminDashboard = [PermissionService::ADMIN_DASHBOARD];
        $rolePermissions = [PermissionService::ROLE_ACCESS, PermissionService::ROLE_STORE_UPDATE, PermissionService::ROLE_DELETE];
        $permissionPermissions = [PermissionService::PERMISSION_ACCESS, PermissionService::PERMISSION_STORE_UPDATE, PermissionService::PERMISSION_DELETE];
        $userPermissions = [PermissionService::USER_ACCESS, PermissionService::USER_STORE_UPDATE, PermissionService::USER_DELETE];
        $accountPermissions = [PermissionService::ACCOUNT_ACCESS, PermissionService::ACCOUNT_STORE_UPDATE, PermissionService::ACCOUNT_DELETE];

        Role::create(['name' => 'AdminRole'])
            ->givePermissionTo([
                ...$adminDashboard,
                ...$rolePermissions,
                ...$permissionPermissions,
                ...$userPermissions,
                ...$accountPermissions,
            ]);

        Role::create(['name' => 'UserRole'])
            ->givePermissionTo([
                ...$accountPermissions,
            ]);
    }

}
