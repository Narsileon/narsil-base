<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms;

#region USE

use Illuminate\Support\Fluent;

#endregion

/**
 * @property string $type The value of the "type" attribute.
 */
abstract class InputData extends Fluent
{
    #region CONSTRUCTOR

    /**
     * @param string $type The value of the "type" attribute.
     *
     * @return void
     */
    public function __construct(string $type)
    {
        $this->set(self::TYPE, $type);

        static::registerTranslations();
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "default value" attribute.
     *
     * @var string
     */
    final public const DEFAULT_VALUE = 'defaultValue';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    public const TYPE = 'type';

    #endregion

    #region PUBLIC METHODS

    /**
     * Get the form of the input.
     *
     * @param string|null $prefix
     *
     * @return InputData[]
     */
    public static function getInputForm(?string $prefix = null): array
    {
        return [];
    }

    /**
     * Register the translations for the input.
     *
     * @return void
     */
    public static function registerTranslations(): void
    {
        //
    }

    #endregion
}
