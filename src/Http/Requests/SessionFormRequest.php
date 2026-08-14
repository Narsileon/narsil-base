<?php

namespace Narsil\Base\Http\Requests;

#region USE

use Illuminate\Foundation\Http\FormRequest;
use Narsil\Base\Validation\FormRule;

#endregion

class SessionFormRequest extends FormRequest
{
    #region CONSTANTS

    /**
     * The name of the "type" parameter.
     *
     * @var string
     */
    public const TYPE = 'type';

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            self::TYPE => [
                FormRule::STRING,
                FormRule::REQUIRED,
            ],
        ];
    }

    #endregion
}
