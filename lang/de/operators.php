<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\OperatorEnum;

#endregion

return [
    OperatorEnum::AFTER_OR_EQUAL->value => 'nach oder gleich',
    OperatorEnum::AFTER->value => 'nach',
    OperatorEnum::BEFORE_OR_EQUAL->value => 'vor oder gleich',
    OperatorEnum::BEFORE->value => 'vor',
    OperatorEnum::CONTAINS->value => 'enthält',
    OperatorEnum::DOESNT_END_WITH->value => 'endet nicht mit',
    OperatorEnum::DOESNT_START_WITH->value => 'beginnt nicht mit',
    OperatorEnum::ENDS_WITH->value => 'endet mit',
    OperatorEnum::EQUALS->value => 'gleich',
    OperatorEnum::GREATER_THAN_OR_EQUAL->value => 'größer oder gleich',
    OperatorEnum::GREATER_THAN->value => 'größer als',
    OperatorEnum::LESS_THAN_OR_EQUAL->value => 'kleiner oder gleich',
    OperatorEnum::LESS_THAN->value => 'kleiner als',
    OperatorEnum::NOT_CONTAINS->value => 'enthält nicht',
    OperatorEnum::NOT_EQUALS->value => 'nicht gleich',
    OperatorEnum::STARTS_WITH->value => 'beginnt mit',
];
