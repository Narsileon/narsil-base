<?php

namespace Narsil\Base\Actions;

#region USE

use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Narsil\Base\Contracts\Requests\Fortify\CreateNewUserFormRequest;
use Narsil\Base\Models\User;

#endregion

class CreateNewUser implements CreatesNewUsers
{
    #region PUBLIC METHODS

    /**
     * @param array<string,mixed> $input
     *
     * @return User
     */
    public function create(array $input): User
    {
        $rules = app(CreateNewUserFormRequest::class)
            ->rules();

        $attributes = Validator::make($input, $rules)
            ->validated();

        $user = new User();

        $user
            ->forceFill($attributes)
            ->save();

        return $user;
    }

    #endregion
}
