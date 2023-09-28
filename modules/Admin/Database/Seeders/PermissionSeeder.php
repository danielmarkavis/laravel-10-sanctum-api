<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Services\PermissionService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            PermissionService::ADMIN_DASHBOARD,

            PermissionService::PERMISSION_ACCESS,
            PermissionService::PERMISSION_STORE_UPDATE,
            PermissionService::PERMISSION_DELETE,

            PermissionService::ROLE_ACCESS,
            PermissionService::ROLE_STORE_UPDATE,
            PermissionService::ROLE_DELETE,

            PermissionService::USER_ACCESS,
            PermissionService::USER_STORE_UPDATE,
            PermissionService::USER_DELETE,

            PermissionService::ACCOUNT_ACCESS,
            PermissionService::ACCOUNT_STORE_UPDATE,
            PermissionService::ACCOUNT_DELETE,
        ];

        // create permissions
        foreach ($permissions as $permission ) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
