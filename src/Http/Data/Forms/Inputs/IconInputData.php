<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\InputData;

#endregion

/**
 * @property string $defaultValue The value of the "default value" attribute.
 */
class IconInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'icon';

    #endregion
}
