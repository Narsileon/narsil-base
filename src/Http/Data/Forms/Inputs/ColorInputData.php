<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;
use Narsil\Base\Support\TranslationsBag;

#endregion

/**
 * @property string $defaultValue The value of the "default value" attribute.
 * @property boolean $alpha The value of the "alpha" attribute.
 */
class ColorInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param boolean $alpha The value of the "alpha" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        bool $alpha = false,
    )
    {
        $this->set(self::ALPHA, $alpha);
        $this->set(self::DEFAULT_VALUE, $defaultValue);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "alpha" attribute.
     *
     * @var string
     */
    final public const ALPHA = 'alpha';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'color';

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
                input: new ColorInputData(),
            ),
            new FieldData(
                id: static::ALPHA,
                prefix: $prefix,
                input: new SwitchInputData(),
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
