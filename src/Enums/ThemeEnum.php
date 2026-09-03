<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Traits\Enumerable;

#endregion

enum ThemeEnum: string
{
    use Enumerable;

    #region CASES

    /**
     * @var string
     */
    case SYSTEM = 'system';
    /**
     * @var string
     */
    case LIGHT = 'light';
    /**
     * @var string
     */
    case DARK = 'dark';

    #endregion

    #region PUBLIC METHODS

    /**
     * Get the enum value as an option.
     *
     * @param OperatorEnum $case
     *
     * @return OptionData
     */
    public static function option(OperatorEnum $case): OptionData
    {
        return new OptionData(
            label: trans('narsil::themes.' . $case->value),
            value: $case->value
        );
    }

    #endregion
}
