<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\RuleEnum;

#endregion

return [
    RuleEnum::ALPHA_DASH->value => 'Alphanumérique avec tirets',
    RuleEnum::ARRAY->value => 'Tableau',
    RuleEnum::BOOLEAN->value => 'Booléen',
    RuleEnum::CONFIRMED->value => 'Confirmé',
    RuleEnum::DATE->value => 'Date',
    RuleEnum::DECIMAL->value => 'Décimal',
    RuleEnum::DISTINCT->value => 'Distinct',
    RuleEnum::EMAIL->value => 'E-mail',
    RuleEnum::IMAGE->value => 'Image',
    RuleEnum::INTEGER->value => 'Entier',
    RuleEnum::LOWERCASE->value => 'Minuscules',
    RuleEnum::NULLABLE->value => 'Nullable',
    RuleEnum::NUMERIC->value => 'Numérique',
    RuleEnum::SOMETIMES->value => 'Parfois',
    RuleEnum::STRING->value => 'Chaîne de caractères',
    RuleEnum::URL->value => 'URL',
    RuleEnum::UUID->value => 'UUID',
];
