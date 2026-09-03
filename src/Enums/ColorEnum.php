<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Traits\Enumerable;

#endregion

enum ColorEnum: string
{
    use Enumerable;

    #region CASES

    /**
     * @var string
     */
    case GRAY = 'gray';
    /**
     * @var string
     */
    case RED = 'red';
    /**
     * @var string
     */
    case ORANGE  = 'orange';
    /**
     * @var string
     */
    case AMBER = 'amber';
    /**
     * @var string
     */
    case YELLOW = 'yellow';
    /**
     * @var string
     */
    case LIME = 'lime';
    /**
     * @var string
     */
    case GREEN = 'green';
    /**
     * @var string
     */
    case EMERALD = 'emerald';
    /**
     * @var string
     */
    case TEAL = 'teal';
    /**
     * @var string
     */
    case CYAN = 'cyan';
    /**
     * @var string
     */
    case SKY = 'sky';
    /**
     * @var string
     */
    case BLUE = 'blue';
    /**
     * @var string
     */
    case INDIGO = 'indigo';
    /**
     * @var string
     */
    case VIOLET = 'violet';
    /**
     * @var string
     */
    case PURPLE = 'purple';
    /**
     * @var string
     */
    case FUCHSIA = 'fuchsia';
    /**
     * @var string
     */
    case PINK = 'pink';
    /**
     * @var string
     */
    case ROSE = 'rose';

    #endregion

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
