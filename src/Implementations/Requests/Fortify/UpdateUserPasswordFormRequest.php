<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Requests\Fortify;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Contracts\Requests\Fortify\UpdateUserPasswordFormRequest as Contract;
use Narsil\Base\Models\User;
use Narsil\Base\Validation\FormRule;

#endregion

class UpdateUserPasswordFormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(?Model $model = null): array
    {
        return [
            User::ATTRIBUTE_CURRENT_PASSWORD => [
                FormRule::STRING,
                FormRule::REQUIRED,
                'current_password:web'
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
