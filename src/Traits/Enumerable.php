<?php

declare(strict_types=1);

namespace Narsil\Base\Traits;

#region USE

use Narsil\Base\Http\Data\OptionData;

#endregion

trait Enumerable
{
    #region PUBLIC METHODS

    /**
     * @return OptionData[]
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case)
        {
            $options[] = new OptionData(
                label: $case->value,
                value: $case->value,
            );
        }

        return $options;
    }

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return array_map(function ($case)
        {
            return $case->value;
        }, self::cases());
    }

    #endregion
}
