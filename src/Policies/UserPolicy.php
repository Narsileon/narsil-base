<?php

namespace Narsil\Base\Policies;

#region USE

use Narsil\Base\Traits\Policies\IsCreatable;
use Narsil\Base\Traits\Policies\IsDeletable;
use Narsil\Base\Traits\Policies\IsUpdatable;
use Narsil\Base\Traits\Policies\IsViewable;

#endregion

class UserPolicy
{
    use IsCreatable;
    use IsDeletable;
    use IsUpdatable;
    use IsViewable;
}
