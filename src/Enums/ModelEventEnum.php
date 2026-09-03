<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Traits\Enumerable;

#endregion

enum ModelEventEnum: string
{
    use Enumerable;

    #region CASES

    /**
     * @var string
     */
    case CREATED = 'created';
    /**
     * @var string
     */
    case DELETED = 'deleted';
    /**
     * @var string
     */
    case REPLICATED = 'replicated';
    /**
     * @var string
     */
    case RESTORED = 'restored';
    /**
     * @var string
     */
    case UPDATED = 'updated';

    /**
     * @var string
     */
    case CREATED_MANY = 'created_many';
    /**
     * @var string
     */
    case DELETED_MANY = 'deleted_many';
    /**
     * @var string
     */
    case REPLICATED_MANY = 'replicated_many';
    /**
     * @var string
     */
    case RESTORED_MANY = 'restored_many';
    /**
     * @var string
     */
    case UPDATED_MANY = 'updated_many';

    #endregion
}
