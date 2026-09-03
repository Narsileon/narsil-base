<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

#region USE

use Narsil\Base\Traits\Enumerable;

#endregion

enum PostgreTypeEnum: string
{
    use Enumerable;

    #region CASES

    /**
     * @var string
     */
    case BIGINT = 'bigint';
    /**
     * @var string
     */
    case BINARY = 'binary';
    /**
     * @var string
     */
    case BOOLEAN = 'boolean';
    /**
     * @var string
     */
    case DATE = 'date';
    /**
     * @var string
     */
    case DATETIME = 'datetime';
    /**
     * @var string
     */
    case DECIMAL = 'decimal';
    /**
     * @var string
     */
    case DOUBLE = 'double';
    /**
     * @var string
     */
    case ENUM = 'enum';
    /**
     * @var string
     */
    case FLOAT = 'float';
    /**
     * @var string
     */
    case FLOAT4 = 'float4';
    /**
     * @var string
     */
    case FLOAT8 = 'float8';
    /**
     * @var string
     */
    case INT2 = 'int2';
    /**
     * @var string
     */
    case INT4 = 'int4';
    /**
     * @var string
     */
    case INT8 = 'int8';
    /**
     * @var string
     */
    case INTEGER = 'integer';
    /**
     * @var string
     */
    case JSON = 'json';
    /**
     * @var string
     */
    case JSONB = 'jsonb';
    /**
     * @var string
     */
    case LONGTEXT = 'longtext';
    /**
     * @var string
     */
    case NUMERIC = 'numeric';
    /**
     * @var string
     */
    case SET = 'set';
    /**
     * @var string
     */
    case SMALLINT = 'smallint';
    /**
     * @var string
     */
    case STRING = 'string';
    /**
     * @var string
     */
    case TEXT = 'text';
    /**
     * @var string
     */
    case TIME = 'time';
    /**
     * @var string
     */
    case TIMESTAMP = 'timestamp';
    /**
     * @var string
     */
    case UUID = 'uuid';
    /**
     * @var string
     */
    case VARCHAR = 'varchar';

    #endregion
}
