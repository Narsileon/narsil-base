<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;

#endregionx

/**
 * @property string $defaultValue The value of the "default value" attribute.
 * @property string $max The value of the "max" attribute.
 * @property string $min The value of the "min" attribute.
 */
class WeekInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param string $max The value of the "max" attribute.
     * @param string $min The value of the "min" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        string $max = '',
        string $min = '',
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::MAX, $max);
        $this->set(self::MIN, $min);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "max" attribute.
     *
     * @var string
     */
    final public const MAX = 'max';

    /**
     * The name of the "min" attribute.
     *
     * @var string
     */
    final public const MIN = 'min';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'week';

    #endregion

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
                input: new WeekInputData(),
            ),
            new FieldData(
                id: static::MIN,
                prefix: $prefix,
                input: new WeekInputData(),
            ),
            new FieldData(
                id: static::MAX,
                prefix: $prefix,
                input: new WeekInputData(),
            ),
        ];
    }

    #endregion
}
