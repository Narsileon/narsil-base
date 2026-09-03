<?php

declare(strict_types=1);

#region USE

use Illuminate\Support\Facades\Route;
use Narsil\Base\Http\Controllers\Policies\Permissions\PermissionEditController;
use Narsil\Base\Http\Controllers\Policies\Permissions\PermissionIndexController;
use Narsil\Base\Http\Controllers\Policies\Permissions\PermissionUpdateController;
use Narsil\Base\Http\Controllers\Policies\Roles\RoleCreateController;
use Narsil\Base\Http\Controllers\Policies\Roles\RoleDestroyController;
use Narsil\Base\Http\Controllers\Policies\Roles\RoleDestroyManyController;
use Narsil\Base\Http\Controllers\Policies\Roles\RoleEditController;
use Narsil\Base\Http\Controllers\Policies\Roles\RoleIndexController;
use Narsil\Base\Http\Controllers\Policies\Roles\RoleReplicateController;
use Narsil\Base\Http\Controllers\Policies\Roles\RoleReplicateManyController;
use Narsil\Base\Http\Controllers\Policies\Roles\RoleStoreController;
use Narsil\Base\Http\Controllers\Policies\Roles\RoleUpdateController;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;

#endregion

Route::middleware([
    'auth',
    'verified',
])->group(
    function ()
    {
        Route::prefix(Permission::TABLE)->name(Permission::TABLE . '.')->group(function ()
        {
            Route::get('/', PermissionIndexController::class)
                ->name('index');
            Route::get('/{permission}/edit', PermissionEditController::class)
                ->name('edit');
            Route::patch('/{permission}', PermissionUpdateController::class)
                ->name('update');
        });

        Route::prefix(Role::TABLE)->name(Role::TABLE . '.')->group(function ()
        {
            Route::get('/', RoleIndexController::class)
                ->name('index');
            Route::get('/create', RoleCreateController::class)
                ->name('create');
            Route::post('/', RoleStoreController::class)
                ->name('store');
            Route::get('/{role}/edit', RoleEditController::class)
                ->name('edit');
            Route::patch('/{role}', RoleUpdateController::class)
                ->name('update');
            Route::delete('/{role}', RoleDestroyController::class)
                ->name('destroy');
            Route::delete('/', RoleDestroyManyController::class)
                ->name('destroy-many');
            Route::post('/{role}/replicate', RoleReplicateController::class)
                ->name('replicate');
            Route::post('/replicate-many', RoleReplicateManyController::class)
                ->name('replicate-many');
        });
    }
);
