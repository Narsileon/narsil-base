<?php

namespace Narsil\Base\Implementations\Requests\Fortify;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Contracts\Requests\Fortify\ResetUserPasswordFormRequest as Contract;
use Narsil\Base\Models\User;
use Narsil\Base\Validation\FormRule;

#endregion

class ResetUserPasswordFormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(?Model $model = null): array
    {
        return [
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
