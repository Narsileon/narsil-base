<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\ThemeEnum;

#endregion

return [
    ThemeEnum::DARK->value => 'Sombre',
    ThemeEnum::LIGHT->value => 'Clair',
    ThemeEnum::SYSTEM->value => 'Auto',
];
