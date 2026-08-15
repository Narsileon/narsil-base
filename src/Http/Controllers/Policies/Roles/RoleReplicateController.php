<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Policies\Roles;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Contracts\Actions\Roles\ReplicateRole;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Services\ModelService;

#endregion

class RoleReplicateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param Role $role
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Role $role): RedirectResponse
    {
        $this->authorize(AbilityEnum::CREATE, Role::class);

        app(ReplicateRole::class)
            ->run($role);

        return back()
            ->with('success', ModelService::getSuccessMessage(Role::TABLE, ModelEventEnum::REPLICATED));
    }

    #endregion
}
