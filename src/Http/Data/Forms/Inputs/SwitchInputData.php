<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;

#endregion

/**
 * @property boolean $defaultValue The value of the "default value" attribute.
 */
class SwitchInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param boolean $defaultValue The value of the "default value" attribute.
     *
     * @return void
     */
    public function __construct(
        bool $defaultValue = false,
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
    final public const TYPE = 'switch';

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public static function getInputForm(?string $prefix = null): array
    {
        return [
            new FieldData(
                id: static::DEFAULT_VALUE,
                prefix: $prefix,
                input: new SwitchInputData(),
            ),
        ];
    }

    #endregion
}
