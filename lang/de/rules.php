<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\RuleEnum;

#endregion

return [
    RuleEnum::ALPHA_DASH->value => 'Alphanumerisch mit Bindestrichen',
    RuleEnum::ARRAY->value => 'Array',
    RuleEnum::BOOLEAN->value => 'Boolesch',
    RuleEnum::CONFIRMED->value => 'Bestätigt',
    RuleEnum::DATE->value => 'Datum',
    RuleEnum::DECIMAL->value => 'Dezimal',
    RuleEnum::DISTINCT->value => 'Eindeutig',
    RuleEnum::EMAIL->value => 'E-Mail',
    RuleEnum::IMAGE->value => 'Bild',
    RuleEnum::INTEGER->value => 'Ganzzahl',
    RuleEnum::LOWERCASE->value => 'Kleinbuchstaben',
    RuleEnum::NULLABLE->value => 'Nullable',
    RuleEnum::NUMERIC->value => 'Numerisch',
    RuleEnum::SOMETIMES->value => 'Manchmal',
    RuleEnum::STRING->value => 'Zeichenkette',
    RuleEnum::URL->value => 'URL',
    RuleEnum::UUID->value => 'UUID',
];
