<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\RuleEnum;

#endregion

return [
    RuleEnum::ALPHA_DASH->value => 'Alpha dash',
    RuleEnum::ARRAY->value => 'Array',
    RuleEnum::BOOLEAN->value => 'Boolean',
    RuleEnum::CONFIRMED->value => 'Confirmed',
    RuleEnum::DATE->value => 'Date',
    RuleEnum::DECIMAL->value => 'Decimal',
    RuleEnum::DISTINCT->value => 'Distinct',
    RuleEnum::EMAIL->value => 'Email',
    RuleEnum::IMAGE->value => 'Image',
    RuleEnum::INTEGER->value => 'Integer',
    RuleEnum::LOWERCASE->value => 'Lowercase',
    RuleEnum::NULLABLE->value => 'Nullable',
    RuleEnum::NUMERIC->value => 'Numeric',
    RuleEnum::SOMETIMES->value => 'Sometimes',
    RuleEnum::STRING->value => 'String',
    RuleEnum::URL->value => 'URL',
    RuleEnum::UUID->value => 'UUID',
];
