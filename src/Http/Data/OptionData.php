<?php

namespace Narsil\Base\Http\Data;

#region USE

use Illuminate\Support\Fluent;

#endregion

/**
 * @property string|array $label The label of the option.
 * @property mixed $value The value of the option.
 */
class OptionData extends Fluent
{
    #region CONSTRUCTOR

    /**
     * @param string $label
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        string|array $label,
        mixed $value,
    )
    {
        $this->set(self::LABEL, $label);
        $this->set(self::VALUE, $value);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "label" attribute.
     *
     * @var string
     */
    final public const LABEL = 'label';

    /**
     * The name of the "value" attribute.
     *
     * @var string
     */
    final public const VALUE = 'value';

    #endregion
}
