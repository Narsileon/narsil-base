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
 * @property string $accept The value of the "accept" attribute.
 */
class FileInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param string $accept The value of the "accept" attribute.
     *
     * @return void
     */
    public function __construct(
        string $defaultValue = '',
        string $accept = '*',
    )
    {
        $this->set(self::ACCEPT, $accept);
        $this->set(self::DEFAULT_VALUE, $defaultValue);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "accept" attribute.
     *
     * @var string
     */
    final public const ACCEPT = 'accept';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'file';

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public static function getInputForm(?string $prefix = null): array
    {
        return [
            new FieldData(
                id: static::ACCEPT,
                prefix: $prefix,
                input: new TextInputData(),
            ),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function registerTranslations(): void
    {
        app(TranslationsBag::class)
            ->add('narsil::file.dnd')
            ->add('narsil::file.upload')
            ->add('narsil::ui.or');
    }

    #endregion
}
