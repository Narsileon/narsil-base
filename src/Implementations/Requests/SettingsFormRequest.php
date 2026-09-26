<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Requests;

#region USE

use Narsil\Base\Contracts\Requests\SettingsFormRequest as Contract;
use Narsil\Base\Enums\ColorEnum;
use Narsil\Base\Implementations\FormRequest;
use Narsil\Base\Models\Setting;
use Narsil\Base\Validation\FormRule;

#endregion

class SettingsFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            Setting::BACKEND_LANGUAGE => [
                FormRule::STRING,
                FormRule::REQUIRED,
            ],
            Setting::DEFAULT_COLOR => [
                FormRule::STRING,
                FormRule::REQUIRED,
                FormRule::in(ColorEnum::values()),
            ],
            Setting::DEFAULT_RADIUS => [
                FormRule::NUMERIC,
                FormRule::REQUIRED,
                FormRule::min(0),
                FormRule::max(1),
            ],
        ];
    }

    #endregion
}
