<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Policies\Permissions;

#region USE

use Illuminate\Http\RedirectResponse;
use Narsil\Base\Contracts\Requests\PermissionFormRequest;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Services\ModelService;

#endregion

class PermissionUpdateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param PermissionFormRequest $request
     * @param Permission $permission
     *
     * @return RedirectResponse
     */
    public function __invoke(PermissionFormRequest $request, Permission $permission): RedirectResponse
    {
        $attributes = $request->validated();

        $permission->update($attributes);

        return $this
            ->redirect(route('permissions.index'))
            ->with('success', ModelService::getSuccessMessage(Permission::TABLE, ModelEventEnum::UPDATED));
    }

    #endregion
}
