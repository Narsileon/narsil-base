<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\AbilityEnum;

#endregion

return [
    AbilityEnum::CREATE->value => 'Create :model',
    AbilityEnum::DELETE_ANY->value => 'Delete any :table',
    AbilityEnum::DELETE->value => 'Delete :model',
    AbilityEnum::UPDATE->value => 'Update :model',
    AbilityEnum::VIEW_ANY->value => 'View any :table',
    AbilityEnum::VIEW->value => 'View :model',
];
