<?php

declare(strict_types=1);

namespace Narsil\Base\Actions;

#region USE

use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Narsil\Base\Contracts\Requests\Fortify\ResetUserPasswordFormRequest;
use Narsil\Base\Models\User;

#endregion

class ResetUserPassword implements ResetsUserPasswords
{
    #region PUBLIC METHODS

    /**
     * @param User $user
     * @param array<string,string> $input
     *
     * @return void
     */
    public function reset(User $user, array $input): void
    {
        $rules = app(ResetUserPasswordFormRequest::class)
            ->rules();

        $attributes = Validator::make($input, $rules)
            ->validated();

        $user
            ->forceFill($attributes)
            ->save();
    }

    #endregion
}
