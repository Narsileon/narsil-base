<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;
use Narsil\Base\Support\TranslationsBag;

#endregionx

/**
 * @property boolean $defaultValue The value of the "default value" attribute.
 * @property string $labelPath The value of the "label path" attribute.
 * @property string $valuePath The value of the "value path" attribute.
 * @property OptionData[]|null $options The value of the "options" attribute.
 */
class CheckboxInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param boolean $defaultValue The value of the "default value" attribute.
     * @param OptionData[]|null $options The value of the "options" attribute.
     *
     * @return void
     */
    public function __construct(
        bool $defaultValue = false,
        string $labelPath = 'label',
        string $valuePath = 'value',
        ?array $options = null,
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::LABEL_PATH, $labelPath);
        $this->set(self::VALUE_PATH, $valuePath);
        $this->set(self::OPTIONS, $options);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "label path" attribute.
     *
     * @var string
     */
    final public const LABEL_PATH = 'labelPath';

    /**
     * The name of the "options" attribute.
     *
     * @var string
     */
    final public const OPTIONS = 'options';

    /**
     * The name of the "value path" attribute.
     *
     * @var string
     */
    final public const VALUE_PATH = 'valuePath';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'checkbox';

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
                input: new CheckboxInputData(),
            ),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function registerTranslations(): void
    {
        app(TranslationsBag::class)
            ->add('narsil::ui.all');
    }

    #endregion
}
