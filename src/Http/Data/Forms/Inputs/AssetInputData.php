<?php

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\InputData;
use Narsil\Base\Support\TranslationsBag;

#endregionx

/**
 * @property string $defaultValue The value of the "default value" attribute.
 */
class AssetInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'asset';

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritdoc}
     */
    public static function registerTranslations(): void
    {
        app(TranslationsBag::class)
            ->add('narsil::ui.browse')
            ->add('narsil::ui.create')
            ->add('narsil::ui.or');
    }

    #endregion
}
