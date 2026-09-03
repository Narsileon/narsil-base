<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Traits\Enumerable;

#endregion

enum RequestMethodEnum: string
{
    use Enumerable;

    #region CASES

    /**
     * @var string
     */
    case DELETE = 'delete';
    /**
     * @var string
     */
    case GET = 'get';
    /**
     * @var string
     */
    case PATCH = 'patch';
    /**
     * @var string
     */
    case POST = 'post';
    /**
     * @var string
     */
    case PUT = 'put';

    #endregion
}
