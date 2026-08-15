<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Users;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Models\User;
use Narsil\Base\Services\ModelService;

#endregion

class UserDestroyController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request, User $user): RedirectResponse
    {
        $this->authorize(AbilityEnum::DELETE, $user);

        $user->delete();

        return $this
            ->redirect(route('users.index'))
            ->with('success', ModelService::getSuccessMessage(User::TABLE, ModelEventEnum::DELETED));
    }

    #endregion
}
