<?php

namespace Narsil\Base\Implementations\Requests\Fortify;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Contracts\Requests\Fortify\CreateNewUserFormRequest as Contract;
use Narsil\Base\Models\User;
use Narsil\Base\Validation\FormRule;

#endregion

class CreateNewUserFormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(?Model $model = null): array
    {
        return [
            User::EMAIL => [
                FormRule::STRING,
                FormRule::EMAIL,
                FormRule::max(255),
                FormRule::REQUIRED,
                FormRule::unique(
                    User::class,
                    User::EMAIL,
                )->ignore($model?->{User::ID}),
            ],
            User::FIRST_NAME => [
                FormRule::STRING,
                FormRule::min(1),
                FormRule::max(255),
                FormRule::REQUIRED,
            ],
            User::LAST_NAME => [
                FormRule::STRING,
                FormRule::min(1),
                FormRule::max(255),
                FormRule::REQUIRED,
            ],
            User::PASSWORD => [
                FormRule::STRING,
                FormRule::min(8),
                FormRule::max(255),
                FormRule::REQUIRED,
                FormRule::CONFIRMED,
            ],
        ];
    }

    #endregion
}
