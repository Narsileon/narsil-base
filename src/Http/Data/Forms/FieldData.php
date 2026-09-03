<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms;

#region USE

use Illuminate\Support\Fluent;
use Narsil\Base\Helpers\Translator;
use Narsil\Base\Http\Data\ConditionData;
use Narsil\Base\Http\Data\Forms\InputData;

#endregion

/**
 * @property string $id The value of the "id" attribute.
 * @property InputData $input The value of the "input" attribute.
 * @property string|null $append The value of the "append" attribute.
 * @property string|null $className The value of the "className" attribute.
 * @property string|null $label The value of the "label" attribute.
 * @property string|null $description The value of the "description" attribute.
 * @property string|null $icon The value of the "icon" attribute.
 * @property string|null $prefix The value of the "prefix" attribute.
 * @property boolean $readonly The value of the "readability" attribute.
 * @property boolean $required The value of the "requirability" attribute.
 * @property boolean $translatable The value of the "translatability" attribute.
 * @property integer $width The value of the "width" attribute.
 * @property ConditionData[] $conditions The value of the "conditions" attribute.
 */
class FieldData extends Fluent
{
    #region CONSTRUCTOR

    /**
     * @param string $id The value of the "id" attribute.
     * @param InputData $input The value of the "input" attribute.
     * @param string|null $append The value of the "append" attribute.
     * @param string|null $className The value of the "className" attribute.
     * @param string|null $description The value of the "description" attribute.
     * @param string|null $icon The value of the "icon" attribute.
     * @param string|null $label The value of the "label" attribute.
     * @param string|null $prefix The value of the "prefix" attribute.
     * @param boolean $readOnly The value of the "readability" attribute.
     * @param boolean $required The value of the "requirability" attribute.
     * @param boolean $translatable The value of the "translatability" attribute.
     * @param integer $width The value of the "width" attribute.
     * @param ConditionData[] $conditions The value of the "conditions" attribute.
     *
     * @return void
     */
    public function __construct(
        string $id,
        InputData $input,
        ?string $append = null,
        ?string $className = null,
        ?string $description = null,
        ?string $icon = null,
        ?string $label = null,
        ?string $prefix = null,
        bool $readOnly = false,
        bool $required = false,
        bool $translatable = false,
        int $width = 100,
        ?array $conditions = [],
    )
    {
        $this->set(self::APPEND, $append);
        $this->set(self::CLASS_NAME, $className);
        $this->set(self::CONDITIONS, $conditions);
        $this->set(self::DESCRIPTION, $description);
        $this->set(self::ICON, $icon);
        $this->set(self::ID, $prefix ? "$prefix.$id" : $id);
        $this->set(self::INPUT, $input);
        $this->set(self::LABEL, $label ?? Translator::trans("validation.attributes.$id"));
        $this->set(self::READONLY, $readOnly);
        $this->set(self::REQUIRED, $required);
        $this->set(self::TRANSLATABLE, $translatable);
        $this->set(self::WIDTH, $width);
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "append" attribute.
     *
     * @var string
     */
    final public const APPEND = 'append';

    /**
     * The name of the "class name" attribute.
     *
     * @var string
     */
    final public const CLASS_NAME = 'className';

    /**
     * The name of the "conditions" attribute.
     *
     * @var string
     */
    final public const CONDITIONS = 'conditions';

    /**
     * The name of the "description" attribute.
     *
     * @var string
     */
    final public const DESCRIPTION = 'description';

    /**
     * The name of the "icon" attribute.
     *
     * @var string
     */
    final public const ICON = 'icon';

    /**
     * The name of the "id" attribute.
     *
     * @var string
     */
    final public const ID = 'id';

    /**
     * The name of the "input" attribute.
     *
     * @var string
     */
    final public const INPUT = 'input';

    /**
     * The name of the "label" attribute.
     *
     * @var string
     */
    final public const LABEL = 'label';

    /**
     * The name of the "read only" attribute.
     *
     * @var string
     */
    final public const READONLY = 'readOnly';

    /**
     * The name of the "required" attribute.
     *
     * @var string
     */
    final public const REQUIRED = 'required';

    /**
     * The name of the "translatable" attribute.
     *
     * @var string
     */
    final public const TRANSLATABLE = 'translatable';

    /**
     * The name of the "width" attribute.
     *
     * @var string
     */
    final public const WIDTH = 'width';

    #endregion
}
