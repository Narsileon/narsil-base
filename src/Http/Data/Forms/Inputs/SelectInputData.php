<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;
use Narsil\Base\Http\Data\OptionData;

#endregion

/**
 * @property string $defaultValue The value of the "default value" attribute.
 * @property bool $multiple The value of the "multiple" attribute.
 * @property string $placeholder The value of the "placeholder" attribute.
 * @property array<int,mixed> $options The value of the "options" attribute.
 * @property bool $renderLabel Whether option labels should render as HTML.
 * @property string|null $reload The value of the "reload" attribute.
 * @property array<int,string> $clearOnReload Field IDs to clear when reloading the form.
 */
class SelectInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param bool $multiple The value of the "multiple" attribute.
     * @param string $placeholder The value of the "placeholder" attribute.
     * @param array<int,mixed> $options The value of the "options" attribute.
     * @param string|null $reload The value of the "reload" attribute.
     * @param array<int,string> $clearOnReload Field IDs to clear when reloading the form.
     * @param bool $renderLabel Whether option labels should render as HTML.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        bool $multiple = false,
        string $placeholder = '',
        array $options = [],
        ?string $reload = null,
        array $clearOnReload = [],
        bool $renderLabel = false,
    ) {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::MULTIPLE, $multiple);
        $this->set(self::OPTIONS, $options);
        $this->set(self::RENDER_LABEL, $renderLabel);
        $this->set(self::PLACEHOLDER, $placeholder);
        $this->set(self::RELOAD, $reload);
        $this->set('clearOnReload', $clearOnReload);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "multiple" attribute.
     *
     * @var string
     */
    final public const MULTIPLE = 'multiple';

    /**
     * The name of the "options" attribute.
     *
     * @var string
     */
    final public const OPTIONS = 'options';

    /**
     * The name of the "placeholder" attribute.
     *
     * @var string
     */
    final public const PLACEHOLDER = 'placeholder';

    /**
     * The name of the "render label" attribute.
     *
     * @var string
     */
    final public const RENDER_LABEL = 'renderLabel';

    /**
     * The name of the "reload" attribute.
     *
     * @var string
     */
    final public const RELOAD = 'reload';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'select';

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public static function getInputForm(?string $prefix = null): array
    {
        return [
            new FieldData(
                id: static::MULTIPLE,
                prefix: $prefix,
                input: new SwitchInputData(),
            ),
            new FieldData(
                id: static::OPTIONS,
                input: new TableInputData(
                    columns: [
                        new FieldData(
                            id: OptionData::VALUE,
                            required: true,
                            input: new TextInputData(),
                        ),
                        new FieldData(
                            id: OptionData::LABEL,
                            required: true,
                            translatable: true,
                            input: new TextInputData(),
                        ),
                    ],
                ),
            ),
        ];
    }

    #endregion
}
