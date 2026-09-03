<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

enum ModelOperationEnum: string
{
    #region CASES

    /**
     * @var string
     */
    case CREATE = 'create';
    /**
     * @var string
     */
    case DESTROY = 'destroy';
    /**
     * @var string
     */
    case DESTROY_MANY = 'destroy-many';
    /**
     * @var string
     */
    case EDIT = 'edit';
    /**
     * @var string
     */
    case INDEX = 'index';
    /**
     * @var string
     */
    case REPLICATE = 'replicate';
    /**
     * @var string
     */
    case REPLICATE_MANY = 'replicate-many';
    /**
     * @var string
     */
    case STORE = 'store';
    /**
     * @var string
     */
    case UPDATE = 'update';

    #endregion
}
