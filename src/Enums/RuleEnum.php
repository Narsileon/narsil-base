<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Traits\Enumerable;

#endregion

enum RuleEnum: string
{
    use Enumerable;

    #region CASES

    /**
     * @var string
     */
    case ALPHA_DASH = 'alpha_dash';
    /**
     * @var string
     */
    case ARRAY = 'array';
    /**
     * @var string
     */
    case BOOLEAN = 'boolean';
    /**
     * @var string
     */
    case CONFIRMED = 'confirmed';
    /**
     * @var string
     */
    case DATE = 'date';
    /**
     * @var string
     */
    case DECIMAL = 'decimal';
    /**
     * @var string
     */
    case DISTINCT = 'distinct';
    /**
     * @var string
     */
    case EMAIL = 'email';
    /**
     * @var string
     */
    case IMAGE = 'image';
    /**
     * @var string
     */
    case INTEGER = 'integer';
    /**
     * @var string
     */
    case LOWERCASE = 'lowercase';
    /**
     * @var string
     */
    case NULLABLE = 'nullable';
    /**
     * @var string
     */
    case NUMERIC = 'numeric';
    /**
     * @var string
     */
    case SOMETIMES = 'sometimes';
    /**
     * @var string
     */
    case STRING = 'string';
    /**
     * @var string
     */
    case URL = 'url';
    /**
     * @var string
     */
    case UUID = 'uuid';

    #endregion
}
