<?php

declare(strict_types=1);

namespace Narsil\Base\Enums;

enum ModelHookEventEnum: string
{
    #region CASES

    /** @var string */
    case AFTER_CREATE = 'after.create';
    /** @var string */
    case AFTER_DESTROY = 'after.destroy';
    /** @var string */
    case AFTER_REPLICATE = 'after.replicate';
    /** @var string */
    case AFTER_STORE = 'after.store';
    /** @var string */
    case AFTER_UPDATE = 'after.update';
    /** @var string */
    case BEFORE_CREATE = 'before.create';
    /** @var string */
    case BEFORE_DESTROY = 'before.destroy';
    /** @var string */
    case BEFORE_REPLICATE = 'before.replicate';
    /** @var string */
    case BEFORE_STORE = 'before.store';
    /** @var string */
    case BEFORE_UPDATE = 'before.update';

    #endregion
}
