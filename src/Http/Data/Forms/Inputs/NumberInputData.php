<?php

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;

#endregionx

/**
 * @property integer $defaultValue The value of the "default value" attribute.
 * @property integer|null $max The value of the "max" attribute.
 * @property integer|null $min The value of the "min" attribute.
 * @property float $step The value of the "step" attribute.
 */
class NumberInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param integer $defaultValue The value of the "default value" attribute.
     * @param integer|null $max The value of the "max" attribute.
     * @param integer|null $min The value of the "min" attribute.
     * @param float $step The value of the "step" attribute.
     *
     * @return void
     */
    public function __construct(
        int $defaultValue = 0,
        ?int $max = null,
        ?int $min = null,
        float $step = 1,
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::MAX, $max);
        $this->set(self::MIN, $min);
        $this->set(self::STEP, $step);

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
     * The name of the "step" attribute.
     *
     * @var string
     */
    final public const STEP = 'step';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'number';

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
                input: new NumberInputData(),
            ),
            new FieldData(
                id: static::MIN,
                prefix: $prefix,
                input: new NumberInputData(),
            ),
            new FieldData(
                id: static::MAX,
                prefix: $prefix,
                input: new NumberInputData(),
            ),
            new FieldData(
                id: static::STEP,
                prefix: $prefix,
                input: new NumberInputData(),
            ),
        ];
    }

    #endregion
}
