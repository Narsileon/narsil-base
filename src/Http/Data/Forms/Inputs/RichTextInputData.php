<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Enums\RichTextEditorEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;

#endregion

/**
 * @property string $defaultValue The value of the "default value" attribute.
 * @property string $placeholder The value of the "placeholder" attribute.
 * @property array $modules The value of the "modules" attribute.
 */
class RichTextInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param string $placeholder The value of the "placeholder" attribute.
     * @param array $modules The value of the "modules" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        string $placeholder = '',
        array $modules = [],
    ) {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::PLACEHOLDER, $placeholder);
        $this->set(self::MODULES, $modules);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "modules" attribute.
     *
     * @var string
     */
    final public const MODULES = 'modules';

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
    final public const TYPE = 'rich-text';

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
                input: new RichTextInputData(),
            ),
            new FieldData(
                id: static::PLACEHOLDER,
                prefix: $prefix,
                input: new TextInputData(),
            ),
            new FieldData(
                id: static::MODULES,
                prefix: $prefix,
                input: new CheckboxInputData(
                    options: RichTextEditorEnum::options(),
                ),
            ),
        ];
    }

    #endregion
}
