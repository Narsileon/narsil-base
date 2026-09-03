<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\AbilityEnum;

#endregion

return [
    AbilityEnum::CREATE->value => 'Créer des :table',
    AbilityEnum::DELETE_ANY->value => 'Supprimer des :table',
    AbilityEnum::DELETE->value => 'Supprimer des :table',
    AbilityEnum::UPDATE->value => 'Mettre à jour les :table',
    AbilityEnum::VIEW_ANY->value => 'Voir les :table',
    AbilityEnum::VIEW->value => 'Voir les :table',
];
