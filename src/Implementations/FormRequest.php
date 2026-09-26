<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations;

#region USE

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Narsil\Base\Contracts\FormRequest as Contract;

#endregion

abstract class FormRequest extends BaseFormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    #endregion
}
