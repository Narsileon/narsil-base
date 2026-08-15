<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Requests\Fortify;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\File;
use Narsil\Base\Contracts\Requests\Fortify\UpdateUserProfileInformationFormRequest as Contract;
use Narsil\Base\Models\User;
use Narsil\Base\Validation\FormRule;

#endregion

class UpdateUserProfileInformationFormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(?Model $model = null): array
    {
        return [
            User::AVATAR => [
                File::image(),
                FormRule::NULLABLE,
            ],
            User::FIRST_NAME => [
                FormRule::STRING,
                FormRule::min(1),
                FormRule::max(255),
                FormRule::SOMETIMES,
            ],
            User::LAST_NAME => [
                FormRule::STRING,
                FormRule::min(1),
                FormRule::max(255),
                FormRule::SOMETIMES,
            ],
        ];
    }

    #endregion
}
