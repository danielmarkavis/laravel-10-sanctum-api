<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\UserStoreUpdateRequest;
use App\Models\User;
use Modules\Admin\Models\Role;
use Modules\Admin\Services\PermissionService;
use Modules\Common\Http\Controllers\Traits\CreateEditTrait;
use Modules\Common\Http\Controllers\Contracts\CreateEditInterface;
use Modules\Admin\Repositories\DataTables\UsersIndex;
use Illuminate\Http\Request;

use function array_merge;
use function compact;

class UserController extends Controller implements CreateEditInterface
{
    use CreateEditTrait;

    protected string $index = 'admin.users.index';
    protected string $entity = 'user';
    protected string $indexView = 'Admin/Users/Index';
    protected string $createView = 'Admin/Users/CreateEdit';

    public function formData(): array
    {
        $roles = Role::all();

        return compact('roles');
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
        $record = User::find($id);

        $record->load([
            'roles'
        ]);
        return $record;
    }

    public function getRecords(): UsersIndex
    {
        return new UsersIndex();
    }

    public function getFormRequest(): UserStoreUpdateRequest
    {
        return new UserStoreUpdateRequest();
    }

    public function storeRecord(Request $request, array $data): ?User
    {
//        $record = User::create(
//            array_merge($data, [
//                'name' => $data['name'],
//                'email' => $data['email'],
//            ])
//        );
//
//        $record->syncPermissions(collect($data['roles'])->pluck('name'));

        return null; //$record
    }

    public function updateRecord(Request $request, int $id, array $data): User
    {
        $data = array_merge($data, [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        $record = $this->getRecord($id);
        $record->update($data);

        $record->syncRoles(collect($data['roles'])->pluck('name'));
//        $record->syncRoles($data['roles']);
//        $record->roles()->detach();
//        dd($data['roles'] );
//        foreach(collect($data['roles'])->pluck('name') as $role) {
//            $record->assignRole($role);
//        }

        return $record;
    }

    public function deleteRecord(int $id): User
    {
        $record = $this->getRecord($id);

        $record->delete();

        return $record;
    }

    public function getPermissions(): array
    {
        return [
            'view' => PermissionService::USER_ACCESS,
            'storeUpdate' => PermissionService::USER_STORE_UPDATE,
            'delete' => PermissionService::USER_DELETE
        ];
    }
}
