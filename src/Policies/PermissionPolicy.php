<?php

declare(strict_types=1);

namespace Narsil\Base\Policies;

#region USE

use Narsil\Base\Traits\Policies\IsUpdatable;
use Narsil\Base\Traits\Policies\IsViewable;

#endregion

class PermissionPolicy
{
    use IsUpdatable;
    use IsViewable;
}
