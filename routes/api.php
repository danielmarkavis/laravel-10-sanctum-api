<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware(['auth:sanctum'])
//    ->group(function () {
//
//        //        Route::resource('users', UserController::class, ['as' => 'admin'])
//        //            ->parameters(['users' => 'user'])->except(['create','store']);
//        //
//        //        Route::resource('roles', RoleController::class, ['as' => 'admin'])
//        //            ->parameters(['roles' => 'role'])->only(['index','store','update','destroy']);
//
//        Route::resource('permissions', PermissionController::class)
//            ->parameters(['permissions' => 'permission']);//->only(['index','store','update','destroy']);
//
//    });
