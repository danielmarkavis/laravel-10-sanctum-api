<?php

namespace Modules\Admin\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionService
{

    protected ?User $user;

    const ADMIN_DASHBOARD = 'AdminDashboard';
    const PERMISSION_ACCESS = 'PermissionAccess';
    const PERMISSION_STORE_UPDATE = 'PermissionStoreUpdate';
    const PERMISSION_DELETE = 'PermissionDelete';
    const ROLE_ACCESS = 'RoleAccess';
    const ROLE_STORE_UPDATE = 'RoleStoreUpdate';
    const ROLE_DELETE = 'RoleDelete';
    const USER_ACCESS = 'UserAccess';
    const USER_STORE_UPDATE = 'UserStoreUpdate';
    const USER_DELETE = 'UserDelete';
    const ACCOUNT_ACCESS = 'AccountAccess';
    const ACCOUNT_STORE_UPDATE = 'AccountStoreUpdate';
    const ACCOUNT_DELETE = 'AccountDelete';

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    public function getAllRoles(): Collection
    {
        return Role::query()
            ->orderBy('name')
            ->get();
    }

    public function getAllPermissions(): Collection
    {
        return Permission::query()
            ->orderBy('name')
            ->get();
    }

    public function getAllUsers(): Collection
    {
        return User::query()
            ->orderBy('name')
            ->get();
    }

    public function getProtectedRoles(): ?array
    {
        return explode(',', env('PROTECTED_ROLES'));
    }

}