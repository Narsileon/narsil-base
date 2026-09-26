<?php

declare(strict_types=1);

namespace Narsil\Base\Contracts;

#region USE

use Illuminate\Contracts\Validation\ValidationRule;

#endregion

/**
 * @method array<string,mixed> validated()
 */
interface FormRequest
{
    #region PUBLIC METHODS

    /**
     * @return array<string,ValidationRule|array<mixed>|string>
     */
    public function rules(): array;

    #endregion
}
