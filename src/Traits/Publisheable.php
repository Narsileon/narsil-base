<?php

namespace Narsil\Base\Traits;

trait Publisheable
{
    #region CONSTANTS

    #region • COLUMNS

    /**
     * The name of the "published" column.
     *
     * @var string
     */
    final public const PUBLISHED = 'published';

    /**
     * The name of the "published from" column.
     *
     * @var string
     */
    final public const PUBLISHED_FROM = 'published_from';

    /**
     * The name of the "published to" column.
     *
     * @var string
     */
    final public const PUBLISHED_TO = 'published_to';

    #endregion

    #endregion
}
