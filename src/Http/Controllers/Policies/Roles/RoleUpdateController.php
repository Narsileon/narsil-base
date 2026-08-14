<?php

namespace Narsil\Base\Http\Controllers\Policies\Roles;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Narsil\Base\Contracts\Actions\Roles\SyncRolePermissions;
use Narsil\Base\Contracts\Requests\RoleFormRequest;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Services\ModelService;

#endregion

class RoleUpdateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param RoleFormRequest $request
     * @param Role $role
     *
     * @return RedirectResponse
     */
    public function __invoke(RoleFormRequest $request, Role $role): RedirectResponse
    {
        $attributes = $request->validated();

        $role->update($attributes);

        app(SyncRolePermissions::class)
            ->run($role, Arr::get($attributes, Role::RELATION_PERMISSIONS, []));

        return $this
            ->redirect(route('roles.index'))
            ->with('success', ModelService::getSuccessMessage(Role::TABLE, ModelEventEnum::UPDATED));
    }

    #endregion
}
