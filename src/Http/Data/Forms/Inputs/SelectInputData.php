<?php

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;
use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Support\TranslationsBag;

#endregionx

/**
 * @property string $defaultValue The value of the "default value" attribute.
 * @property boolean $multiple The value of the "multiple" attribute.
 * @property string $placeholder The value of the "placeholder" attribute.
 * @property OptionData[] $options The value of the "options" attribute.
 */
class SelectInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param boolean $multiple The value of the "multiple" attribute.
     * @param string $placeholder The value of the "placeholder" attribute.
     * @param OptionData[] $options The value of the "options" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        bool $multiple = false,
        string $placeholder = '',
        array $options = []
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::MULTIPLE, $multiple);
        $this->set(self::OPTIONS, $options);
        $this->set(self::PLACEHOLDER, $placeholder);

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

    /**
     * {@inheritdoc}
     */
    public static function registerTranslations(): void
    {
        app(TranslationsBag::class)
            ->add('narsil::placeholders.choose')
            ->add('narsil::placeholders.search');
    }

    #endregion
}
