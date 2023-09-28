<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Common\Http\Controllers\Traits\SearchableTrait;
use Modules\Common\Http\Controllers\Traits\SortableTrait;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;
    use SearchableTrait;
    use SortableTrait;

//    protected $table = "roles";

    public function getSearchableColumns(): array
    {
        return [
            'name',
        ];
    }

    public function getSortableColumns(): array
    {
        return [
            'name',
        ];
    }

    public function permissions(): BelongsToMany
    {
        return $this
            ->belongsToMany(Permission::class, 'role_has_permissions')
            ->orderByPivot('role_id' );
    }

}
