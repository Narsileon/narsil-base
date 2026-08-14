<?php

namespace Narsil\Base\Http\Controllers\Users;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Narsil\Base\Contracts\Actions\Users\SyncUserPermissions;
use Narsil\Base\Contracts\Actions\Users\SyncUserRoles;
use Narsil\Base\Contracts\Requests\UserFormRequest;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Models\User;
use Narsil\Base\Services\ModelService;

#endregion

class UserUpdateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param UserFormRequest $request
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function __invoke(UserFormRequest $request, User $user): RedirectResponse
    {
        $attributes = $request->validated();

        if (empty(Arr::get($attributes, User::PASSWORD)))
        {
            unset($attributes[User::PASSWORD]);
            unset($attributes[User::ATTRIBUTE_PASSWORD_CONFIRMATION]);
        }

        $user->update($attributes);

        app(SyncUserRoles::class)
            ->run($user, Arr::get($attributes, User::RELATION_ROLES, []));
        app(SyncUserPermissions::class)
            ->run($user, Arr::get($attributes, User::RELATION_PERMISSIONS, []));

        return $this
            ->redirect(route('users.index'))
            ->with('success', ModelService::getSuccessMessage(User::TABLE, ModelEventEnum::UPDATED));
    }

    #endregion
}
