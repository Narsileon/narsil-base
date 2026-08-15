<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;

#endregionx

/**
 * @property string $defaultValue The value of the "default value" attribute.
 * @property string $autoComplete The value of the "auto complete" attribute.
 * @property boolean $multiple The value of the "multiple" attribute.
 * @property string $placeholder The value of the "placeholder" attribute.
 */
class EmailInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param string $autoComplete The value of the "auto complete" attribute.
     * @param boolean $multiple The value of the "multiple" attribute.
     * @param string $placeholder The value of the "placeholder" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        string $autoComplete = 'off',
        bool $multiple = false,
        string $placeholder = '',
    )
    {
        $this->set(self::AUTO_COMPLETE, $autoComplete);
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::MULTIPLE, $multiple);
        $this->set(self::PLACEHOLDER, $placeholder);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "auto complete" attribute.
     *
     * @var string
     */
    final public const AUTO_COMPLETE = 'autoComplete';

    /**
     * The name of the "multiple" attribute.
     *
     * @var string
     */
    final public const MULTIPLE = 'multiple';

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
    final public const TYPE = 'email';

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
                input: new EmailInputData(),
            ),
            new FieldData(
                id: static::PLACEHOLDER,
                prefix: $prefix,
                input: new TextInputData(),
            ),
            new FieldData(
                id: static::AUTO_COMPLETE,
                prefix: $prefix,
                input: new TextInputData(),
            ),
            new FieldData(
                id: static::MULTIPLE,
                prefix: $prefix,
                input: new SwitchInputData(),
            ),
        ];
    }

    #endregion
}
