<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms\Inputs;

#region USE

use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\InputData;
use Narsil\Base\Http\Data\OptionData;

#endregionx

/**
 * @property boolean $defaultValue The value of the "default value" attribute.
 * @property OptionData[] $options The value of the "options" attribute.
 */
class RadioInputData extends InputData
{
    #region CONSTRUCTOR

    /**
     * @param string $defaultValue The value of the "default value" attribute.
     * @param OptionData[] $options The value of the "options" attribute.
     *
     * @return void
     */
    public function __construct(
        bool $defaultValue = false,
        array $options = []
    )
    {
        $this->set(self::DEFAULT_VALUE, $defaultValue);
        $this->set(self::OPTIONS, $options);

        parent::__construct(static::TYPE);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "options" attribute.
     *
     * @var string
     */
    final public const OPTIONS = 'options';

    /**
     * The name of the "type" attribute.
     *
     * @var string
     */
    final public const TYPE = 'radio';

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public static function getInputForm(?string $prefix = null): array
    {
        return [
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
