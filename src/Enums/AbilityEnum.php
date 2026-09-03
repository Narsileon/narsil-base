<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Traits\Enumerable;

#endregion

enum AbilityEnum: string
{
    use Enumerable;

    #region CASES

    /**
     * @var string
     */
    case CREATE     = 'create';
    /**
     * @var string
     */
    case DELETE     = 'delete';
    /**
     * @var string
     */
    case DELETE_ANY = 'deleteAny';
    /**
     * @var string
     */
    case UPDATE     = 'update';
    /**
     * @var string
     */
    case VIEW       = 'view';
    /**
     * @var string
     */
    case VIEW_ANY   = 'viewAny';

    #endregion
}
