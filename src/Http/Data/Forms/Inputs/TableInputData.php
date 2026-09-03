<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;
use Narsil\Base\Support\TranslationsBag;

#endregion

/**
 * @property array $defaultValue The value of the "default value" attribute.
 * @property FieldData[] $columns The value of the "columns" attribute.
 */
class TableInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param array $defaultValue The value of the "default value" attribute.
     * @param FieldData[] $columns The value of the "columns" attribute.
     *
     * @return void
     */
    public function __construct(
        array $defaultValue = [],
        array $columns = [],
    )
    {
        $this->set(self::COLUMNS, $columns);
        $this->set(self::DEFAULT_VALUE, $defaultValue);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "columns" attribute.
     *
     * @var string
     */
    final public const COLUMNS = 'columns';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'table';

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritdoc}
     */
    public static function registerTranslations(): void
    {
        app(TranslationsBag::class)
            ->add('narsil::ui.add')
            ->add('narsil::ui.delete')
            ->add('narsil::ui.move_down')
            ->add('narsil::ui.move_up');
    }

    #endregion
}
