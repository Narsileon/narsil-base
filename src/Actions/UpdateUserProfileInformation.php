<?php

namespace Narsil\Base\Actions;

#region USE

use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Narsil\Base\Contracts\Requests\Fortify\UpdateUserProfileInformationFormRequest;
use Narsil\Base\Models\User;

#endregion

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    #region PUBLIC METHODS

    /**
     * @param User $user
     * @param array<string,mixed> $input
     *
     * @return void
     */
    public function update(User $user, array $input): void
    {
        $rules = app(UpdateUserProfileInformationFormRequest::class)
            ->rules();

        $attributes = Validator::make($input, $rules)
            ->validated();

        $user
            ->forceFill($attributes)
            ->save();
    }

    #endregion
}
