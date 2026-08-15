<?php

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Traits\Enumerable;

#endregion

enum AbilityEnum: string
{
    use Enumerable;

    case CREATE     = 'create';
    case DELETE     = 'delete';
    case DELETE_ANY = 'deleteAny';
    case UPDATE     = 'update';
    case VIEW       = 'view';
    case VIEW_ANY   = 'viewAny';
}
