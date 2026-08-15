<?php

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Traits\Enumerable;

#endregion

enum ColorEnum: string
{
    use Enumerable;

    case GRAY = 'gray';
    case RED = 'red';
    case ORANGE  = 'orange';
    case AMBER = 'amber';
    case YELLOW = 'yellow';
    case LIME = 'lime';
    case GREEN = 'green';
    case EMERALD = 'emerald';
    case TEAL = 'teal';
    case CYAN = 'cyan';
    case SKY = 'sky';
    case BLUE = 'blue';
    case INDIGO = 'indigo';
    case VIOLET = 'violet';
    case PURPLE = 'purple';
    case FUCHSIA = 'fuchsia';
    case PINK = 'pink';
    case ROSE = 'rose';

    #region PUBLIC METHODS

    /**
     * Get the enum as options.
     *
     * @return OptionData[]
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::values() as $value)
        {
            $label = view('narsil::components.color-label', [
                'color' => $value,
                'label' => trans("narsil::colors.$value"),
            ])->render();

            $options[] = new OptionData(
                label: $label,
                value: $value
            );
        }

        return $options;
    }

    #endregion
}
