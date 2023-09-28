<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\RoleStoreUpdateRequest;
use Modules\Admin\Models\AdminPermission;
use Modules\Admin\Models\Role;
use Modules\Admin\Services\PermissionService;
use Modules\Common\Http\Controllers\Traits\CreateEditTrait;
use Modules\Common\Http\Controllers\Contracts\CreateEditInterface;
use Modules\Admin\Repositories\DataTables\RolesIndex;
use Illuminate\Http\Request;

use function array_merge;
use function compact;

class RoleController extends Controller implements CreateEditInterface
{
    use CreateEditTrait;

    protected string $index = 'admin.roles.index';
    protected string $entity = 'role';
    protected string $indexView = 'Admin/Roles/Index';
    protected string $createView = 'Admin/Roles/CreateEdit';

    public function formData(): array
    {
        $permissions = AdminPermission::all();

        return compact('permissions');
    }

    public function dataTableOptions(Request $request): array
    {
        return [
            'search' => '',
            'route' => $this->index,
            'sortBy' => 'name',
            'sortDirection' => 'asc'
        ];
    }

    public function getRecord(int $id)
    {
        $record = Role::find($id);

        $record->load([
            'permissions'
        ]);

        return $record;
    }

    public function getRecords(): RolesIndex
    {
        return new RolesIndex();
    }

    public function getFormRequest(): RoleStoreUpdateRequest
    {
        return new RoleStoreUpdateRequest();
    }

    public function storeRecord(Request $request, array $data): Role
    {
        $record = Role::create(
            array_merge($data, [
                'name' => $data['name'],
            ])
        );

        $record->syncPermissions(collect($data['permissions'])->pluck('name'));

        return $record;
    }

    public function updateRecord(Request $request, int $id, array $data): Role
    {
        $data = array_merge($data, [
            'name' => $data['name'],
        ]);
        $record = $this->getRecord($id);
        $record->update($data);

        $record->syncPermissions(collect($data['permissions'])->pluck('name'));

        return $record;
    }

    public function deleteRecord(int $id): Role
    {
        $record = $this->getRecord($id);

        $record->delete();

        return $record;
    }

    public function getPermissions(): array
    {
        return [
            'view' => PermissionService::ROLE_ACCESS,
            'storeUpdate' => PermissionService::ROLE_STORE_UPDATE,
            'delete' => PermissionService::ROLE_DELETE
        ];
    }
}
