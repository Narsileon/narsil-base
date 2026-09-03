<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\OperatorEnum;

#endregion

return [
    OperatorEnum::AFTER_OR_EQUAL->value => 'après ou égal',
    OperatorEnum::AFTER->value => 'après',
    OperatorEnum::BEFORE_OR_EQUAL->value => 'avant ou égal',
    OperatorEnum::BEFORE->value => 'avant',
    OperatorEnum::CONTAINS->value => 'contient',
    OperatorEnum::DOESNT_END_WITH->value => 'ne se termine pas par',
    OperatorEnum::DOESNT_START_WITH->value => 'ne commence pas par',
    OperatorEnum::ENDS_WITH->value => 'se termine par',
    OperatorEnum::EQUALS->value => 'égal à',
    OperatorEnum::GREATER_THAN_OR_EQUAL->value => 'supérieur ou égal à',
    OperatorEnum::GREATER_THAN->value => 'supérieur à',
    OperatorEnum::LESS_THAN_OR_EQUAL->value => 'inférieur ou égal à',
    OperatorEnum::LESS_THAN->value => 'inférieur à',
    OperatorEnum::NOT_CONTAINS->value => 'ne contient pas',
    OperatorEnum::NOT_EQUALS->value => 'différent de',
    OperatorEnum::STARTS_WITH->value => 'commence par',
];
