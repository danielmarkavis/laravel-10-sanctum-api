<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Admin\Services\PermissionService;
use Modules\Admin\Models\AdminPermission;
use Illuminate\Http\Request;

use function array_merge;
use function compact;

class PermissionController extends Controller
{
    protected object $permissions;

    public function __construct()
    {
        $this->permissions = (object)[
            'view' => PermissionService::PERMISSION_ACCESS,
            'storeUpdate' => PermissionService::PERMISSION_STORE_UPDATE,
            'delete' => PermissionService::PERMISSION_DELETE
        ];
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        abort_if(Gate::denies($this->permissions->view), 403);

        $permissions = AdminPermission::all();

        return response()->json($permissions);
    }
}
