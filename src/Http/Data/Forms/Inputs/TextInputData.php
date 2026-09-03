<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;

#endregion

/**
 * @property string $defaultValue The value of The value of the "default value" attribute.
 * @property string $autoComplete The value of The value of the "auto complete" attribute.
 * @property integer $maxLength The value of The value of the "max length" attribute of theut.
 * @property integer $minLength The value of The value of the "min length" attribute.
 * @property string $placeholder The value of The value of the "placeholder" attribute.
 */
class TextInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param string $autoComplete The value of the "auto complete" attribute.
     * @param integer $maxLength The value of the "max length" attribute.
     * @param integer $minLength The value of the "min length" attribute.
     * @param string $placeholder The value of the "placeholder" attribute.
     *
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        string $autoComplete = 'off',
        int $maxLength = 255,
        int $minLength = 0,
        string $placeholder = '',

    )
    {
        $this->set(self::AUTO_COMPLETE, $autoComplete);
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::MAX_LENGTH, $maxLength);
        $this->set(self::MIN_LENGTH, $minLength);
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
     * The name of the "max length" attribute.
     *
     * @var string
     */
    final public const MAX_LENGTH = 'maxLength';

    /**
     * The name of the "min length" attribute.
     *
     * @var string
     */
    final public const MIN_LENGTH = 'minLength';

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
    final public const TYPE = 'text';

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
            new FieldData(
                id: static::AUTO_COMPLETE,
                prefix: $prefix,
                input: new TextInputData(),
            ),
            new FieldData(
                id: static::MIN_LENGTH,
                prefix: $prefix,
                input: new NumberInputData(),
            ),
            new FieldData(
                id: static::MAX_LENGTH,
                prefix: $prefix,
                input: new NumberInputData(),
            ),
        ];
    }

    #endregion
}
