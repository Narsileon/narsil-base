<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\OperatorEnum;

#endregion

return [
    OperatorEnum::AFTER_OR_EQUAL->value => 'after or equal',
    OperatorEnum::AFTER->value => 'after',
    OperatorEnum::BEFORE_OR_EQUAL->value => 'before or equal',
    OperatorEnum::BEFORE->value => 'before',
    OperatorEnum::CONTAINS->value => 'contains',
    OperatorEnum::DOESNT_END_WITH->value => "doesn't end with",
    OperatorEnum::DOESNT_START_WITH->value => "doesn't start with",
    OperatorEnum::ENDS_WITH->value => 'ends with',
    OperatorEnum::EQUALS->value => 'equals',
    OperatorEnum::GREATER_THAN_OR_EQUAL->value => 'greater than or equal',
    OperatorEnum::GREATER_THAN->value => 'greater than',
    OperatorEnum::LESS_THAN_OR_EQUAL->value => 'less than or equal',
    OperatorEnum::LESS_THAN->value => 'less than',
    OperatorEnum::NOT_CONTAINS->value => "doesn't contain",
    OperatorEnum::NOT_EQUALS->value => 'not equals',
    OperatorEnum::STARTS_WITH->value => 'starts with',
];
