<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Requests;

#region USE

use Illuminate\Foundation\Http\FormRequest;
use Narsil\Base\Validation\FormRule;

#endregion

class ReplicateManyRequest extends FormRequest
{
    #region CONSTANTS

    /**
     * @var string
     */
    public const IDS = 'ids';

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            self::IDS => [
                FormRule::ARRAY,
            ],
        ];
    }

    #endregion
}
