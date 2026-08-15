<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Traits\Enumerable;

#endregion

enum RuleEnum: string
{
    use Enumerable;

    case ALPHA_DASH = 'alpha_dash';
    case ARRAY = 'array';
    case BOOLEAN = 'boolean';
    case CONFIRMED = 'confirmed';
    case DATE = 'date';
    case DECIMAL = 'decimal';
    case DISTINCT = 'distinct';
    case EMAIL = 'email';
    case IMAGE = 'image';
    case INTEGER = 'integer';
    case LOWERCASE = 'lowercase';
    case NULLABLE = 'nullable';
    case NUMERIC = 'numeric';
    case SOMETIMES = 'sometimes';
    case STRING = 'string';
    case URL = 'url';
    case UUID = 'uuid';
}
