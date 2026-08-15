<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;
use Narsil\Base\Support\TranslationsBag;

#endregionx

/**
 * @property array $defaultValue The value of the "default value" attribute.
 * @property string $labelPath The value of the "label path" attribute.
 * @property array<FieldsetData|FieldData> $elements The value of the "elements" attribute.
 */
class ArrayInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param array $defaultValue The value of the "default value" attribute.
     * @param string $labelPath The value of the "label path" attribute.
     * @param array<FieldsetData|FieldData> $elements The value of the "elements" attribute.
     *
     * @return void
     */
    public function __construct(
        array $defaultValue = [],
        string $labelPath = 'label',
        array $elements = [],
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::ELEMENTS, $elements);
        $this->set(self::LABEL_PATH, $labelPath);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "elements" attribute.
     *
     * @var string
     */
    final public const ELEMENTS = 'elements';

    /**
     * The name of the "options" attribute.
     *
     * @var string
     */
    final public const LABEL_PATH = 'labelPath';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'array';

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritdoc}
     */
    public static function registerTranslations(): void
    {
        app(TranslationsBag::class)
            ->add('narsil::ui.add')
            ->add('narsil::ui.collapse')
            ->add('narsil::ui.delete')
            ->add('narsil::ui.expand')
            ->add('narsil::ui.move_down')
            ->add('narsil::ui.move_up');
    }

    #endregion
}
