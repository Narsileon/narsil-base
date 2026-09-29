<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormBlock extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $baseId
     * @param mixed $fieldset
     * @param mixed $formData
     * @param mixed $languages
     * @param mixed $options
     * @param string|null $model
     *
     * @return void
     */
    public function __construct(
        mixed $baseId = null,
        mixed $fieldset = null,
        mixed $formData = null,
        mixed $languages = null,
        mixed $options = [],
        ?string $model = null,
    ) {
        $fieldsetBaseId = $baseId ?? data_get($fieldset, 'id');
        $virtual = data_get($fieldset, 'virtual') === true;
        $fieldsetElements = data_get($fieldset, 'elements', []);
        $elements = $this->getElements($fieldsetBaseId, $virtual, $fieldsetElements, $formData);

        $this->baseId = $baseId;
        $this->collapsible = (bool) data_get($fieldset, 'collapsible', false);
        $this->fieldset = $fieldset;
        $this->fieldsetBaseId = $fieldsetBaseId;
        $this->fieldsetLabel = data_get($fieldset, 'label', '');
        $this->elements = $elements;
        $this->formData = $formData;
        $this->languages = $languages;
        $this->model = $model;
        $this->options = $options;
        $this->virtual = $virtual;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $baseId;

    /**
     * @var boolean
     */
    public readonly bool $collapsible;

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $elements;

    /**
     * @var mixed
     */
    public readonly mixed $fieldset;

    /**
     * @var mixed
     */
    public readonly mixed $fieldsetBaseId;

    /**
     * @var mixed
     */
    public readonly mixed $fieldsetLabel;

    /**
     * @var mixed
     */
    public readonly mixed $formData;

    /**
     * @var mixed
     */
    public readonly mixed $languages;

    /**
     * @var string|null
     */
    public readonly ?string $model;

    /**
     * @var mixed
     */
    public readonly mixed $options;

    /**
     * @var boolean
     */
    public readonly bool $virtual;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-block');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $fieldsetBaseId
     * @param boolean $virtual
     * @param mixed $fieldsetElements
     * @param mixed $formData
     *
     * @return array<int,array<string,mixed>>
     */
    private function getElements(mixed $fieldsetBaseId, bool $virtual, mixed $fieldsetElements, mixed $formData): array
    {
        $elements = [];

        if (!is_iterable($fieldsetElements))
        {
            return $elements;
        }

        foreach ($fieldsetElements as $fieldsetElement)
        {
            $elementId = data_get($fieldsetElement, 'id');
            $elementVirtualId = $virtual ? $elementId : "$fieldsetBaseId.$elementId";
            $nestedElements = data_get($fieldsetElement, 'elements');

            $elements[] = [
                'element' => $fieldsetElement,
                'id' => $elementVirtualId,
                'isFieldset' => is_iterable($nestedElements),
                'value' => data_get($formData, $elementVirtualId),
            ];
        }

        return $elements;
    }

    #endregion
}
