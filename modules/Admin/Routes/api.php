<?php

use Modules\Admin\Http\Controllers\UserController;
use Modules\Admin\Http\Controllers\RoleController;
use Modules\Admin\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','api'])
    ->prefix('api')
    ->group(function () {
//        Route::resource('users', UserController::class, ['as' => 'admin'])
//            ->parameters(['users' => 'user'])->except(['create','store']);
//
//        Route::resource('roles', RoleController::class, ['as' => 'admin'])
//            ->parameters(['roles' => 'role'])->only(['index','store','update','destroy']);

        Route::resource('permissions', PermissionController::class)
            ->parameters(['permissions' => 'permission']);//->only(['index','store','update','destroy']);
    });
