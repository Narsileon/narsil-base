<?php

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Traits\Enumerable;

#endregion

enum ModelEventEnum: string
{
    use Enumerable;

    case CREATED = 'created';
    case DELETED = 'deleted';
    case REPLICATED = 'replicated';
    case RESTORED = 'restored';
    case UPDATED = 'updated';

    case CREATED_MANY = 'created_many';
    case DELETED_MANY = 'deleted_many';
    case REPLICATED_MANY = 'replicated_many';
    case RESTORED_MANY = 'restored_many';
    case UPDATED_MANY = 'updated_many';
}
