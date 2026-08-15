<?php

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;

#endregionx

/**
 * @property string $defaultValue The value of the "default value" attribute.
 * @property string $placeholder The value of the "placeholder" attribute.
 */
class TextareaInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param string $placeholder The value of the "placeholder" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        string $placeholder = '',
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::PLACEHOLDER, $placeholder);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "placeholder" attribute.
     *
     * @var string
     */
    final public const PLACEHOLDER = 'placeholder';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'textarea';

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
                input: new TextInputData(),
            ),
            new FieldData(
                id: static::PLACEHOLDER,
                prefix: $prefix,
                input: new TextInputData(),
            ),
        ];
    }

    #endregion
}
