<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Traits\Enumerable;

#endregion

enum OperatorEnum: string
{
    use Enumerable;

    #region CASES

    /**
     * @var string
     */
    case AFTER = 'after';
    /**
     * @var string
     */
    case AFTER_OR_EQUAL = 'after_or_equal';
    /**
     * @var string
     */
    case BEFORE = 'before';
    /**
     * @var string
     */
    case BEFORE_OR_EQUAL = 'before_or_equal';
    /**
     * @var string
     */
    case CONTAINS = 'contains';
    /**
     * @var string
     */
    case DOESNT_END_WITH = 'doesnt_end_with';
    /**
     * @var string
     */
    case DOESNT_START_WITH = 'doesnt_start_with';
    /**
     * @var string
     */
    case ENDS_WITH = 'ends_with';
    /**
     * @var string
     */
    case EQUALS = 'equals';
    /**
     * @var string
     */
    case GREATER_THAN = 'greater_than';
    /**
     * @var string
     */
    case GREATER_THAN_OR_EQUAL = 'greater_than_or_equal';
    /**
     * @var string
     */
    case LESS_THAN = 'less_than';
    /**
     * @var string
     */
    case LESS_THAN_OR_EQUAL = 'less_than_or_equal';
    /**
     * @var string
     */
    case NOT_CONTAINS = 'not_contains';
    /**
     * @var string
     */
    case NOT_EQUALS = 'not_equals';
    /**
     * @var string
     */
    case STARTS_WITH = 'starts_with';

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
            label: trans('narsil::operators.' . $case->value),
            value: $case->value
        );
    }

    #endregion
}
