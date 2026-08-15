<?php

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Traits\Enumerable;

#endregion

enum RequestMethodEnum: string
{
    use Enumerable;

    case DELETE = 'delete';
    case GET = 'get';
    case PATCH = 'patch';
    case POST = 'post';
    case PUT = 'put';
}
