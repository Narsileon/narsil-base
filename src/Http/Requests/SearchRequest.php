<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Requests;

#region USE

use Illuminate\Foundation\Http\FormRequest;
use Narsil\Base\Validation\FormRule;

#endregion

class SearchRequest extends FormRequest
{
    #region CONSTANTS

    /**
     * The name of the "search" parameter.
     *
     * @var string
     */
    final public const SEARCH = 'search';

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            self::SEARCH => [
                FormRule::STRING,
                FormRule::REQUIRED,
            ],
        ];
    }

    #endregion
}
