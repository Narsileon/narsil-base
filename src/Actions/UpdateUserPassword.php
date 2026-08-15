<?php

declare(strict_types=1);

namespace Narsil\Base\Actions;

#region USE

use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Narsil\Base\Contracts\Requests\Fortify\UpdateUserPasswordFormRequest;
use Narsil\Base\Models\User;

#endregion

class UpdateUserPassword implements UpdatesUserPasswords
{
    #region PUBLIC METHODS

    /**
     * @param User $user
     * @param array<string,string> $input
     *
     * @return void
     */
    public function update(User $user, array $input): void
    {
        $rules = app(UpdateUserPasswordFormRequest::class)
            ->rules();

        $attributes = Validator::make($input, $rules)
            ->validated();

        $user
            ->forceFill([
                User::PASSWORD => $attributes[User::PASSWORD],
            ])
            ->save();
    }

    #endregion
}
