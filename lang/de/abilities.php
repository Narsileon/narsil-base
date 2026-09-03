<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\AbilityEnum;

#endregion

return [
    AbilityEnum::CREATE->value => ':model erstellen',
    AbilityEnum::DELETE_ANY->value => 'Alle :table löschen',
    AbilityEnum::DELETE->value => ':model löschen',
    AbilityEnum::UPDATE->value => ':model aktualisieren',
    AbilityEnum::VIEW_ANY->value => 'Alle :table anzeigen',
    AbilityEnum::VIEW->value => ':model anzeigen',
];
