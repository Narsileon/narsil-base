<?php

declare(strict_types=1);

#region USE

use Narsil\Base\Enums\ThemeEnum;

#endregion

return [
    ThemeEnum::DARK->value => 'Dark',
    ThemeEnum::LIGHT->value => 'Light',
    ThemeEnum::SYSTEM->value => 'Auto',
];
