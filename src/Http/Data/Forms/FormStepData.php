<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\Forms;

#region USE

use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FieldsetData;

#endregion

/**
 * @property string|null $id The value of the "id" attribute.
 * @property string|null $label The value of the "label" attribute.
 * @property string|null $description The value of the "description" attribute.
 * @property array<FieldsetData|InputData> $elements The value of the "elements" attribute.
 */
class FormStepData extends Fluent
{
    #region CONSTRUCTOR

    /**
     * @param string|null $id The value of the "id" attribute.
     * @param string|null $label The value of the "label" attribute.
     * @param string|null $description The value of the "description" attribute.
     * @param array<FieldsetData|FieldData> $elements The value of the "elements" attribute.
     *
     * @return void
     */
    public function __construct(
        ?string $id = null,
        ?string $label = null,
        ?string $description = null,
        array $elements = [],
    )
    {
        $this->set(self::DESCRIPTION, $description);
        $this->set(self::ELEMENTS, $elements);
        $this->set(self::ID, $id);
        $this->set(self::LABEL, Str::ucfirst($label));
    }

    #endregion

    #region CONSTANTS

    /**
     * The name of the "description" attribute.
     *
     * @var string
     */
    final public const DESCRIPTION = 'description';

    /**
     * The name of the "elements" attribute.
     *
     * @var string
     */
    final public const ELEMENTS = 'elements';

    /**
     * The name of the "id" attribute.
     *
     * @var string
     */
    final public const ID = 'id';

    /**
     * The name of the "label" attribute.
     *
     * @var string
     */
    final public const LABEL = 'label';

    #endregion

    #region PROPERTIES

    /**
     * @var string|null
     */
    public ?string $description;

    /**
     * @var array<FieldsetData|FieldData>
     */
    public array $elements;

    /**
     * @var string|null
     */
    public ?string $id;

    /**
     * @var string|null
     */
    public ?string $label;

    #endregion
}
