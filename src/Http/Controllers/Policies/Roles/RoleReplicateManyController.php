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
use Narsil\Base\Http\Requests\ReplicateManyRequest;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Services\ModelService;

#endregion

class RoleReplicateManyController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function __invoke(ReplicateManyRequest $request): RedirectResponse
    {
        $this->authorize(AbilityEnum::CREATE, Role::class);

        $ids = $request->validated(ReplicateManyRequest::IDS);

        $roles = Role::query()
            ->with(Role::RELATION_PERMISSIONS)
            ->findMany($ids);

        foreach ($roles as $role)
        {
            app(ReplicateRole::class)
                ->run($role);
        }

        return back()
            ->with('success', ModelService::getSuccessMessage(Role::TABLE, ModelEventEnum::REPLICATED_MANY));
    }

    #endregion
}
