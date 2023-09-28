<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission;

class AdminPermission extends Permission
{
    use HasFactory;

    protected $table = "permissions";
}
