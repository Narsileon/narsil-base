<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Requests;

#region USE

use Narsil\Base\Contracts\Requests\AssetFormRequest as Contract;
use Narsil\Base\Implementations\FormRequest;

#endregion

class AssetFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    #endregion
}
