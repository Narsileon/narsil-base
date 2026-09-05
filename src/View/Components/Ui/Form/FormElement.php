<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormElement extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $languages
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $languages = [],
        mixed $value = null
    )
    {
        $input = $this->getInput($element);
        $id = $this->getId($element);
        $type = $this->getType($input);
        $translatable = (bool) data_get($element, 'translatable', false);
        $rawValue = $this->getRawValue($id, $input, $value);

        $this->element = $element;
        $this->id = $id;
        $this->input = $input;
        $this->labelFor = $this->getLabelFor($id, $type);
        $this->orientation = $this->getOrientation($input, $type);
        $this->languages = $languages;
        $this->translatable = $translatable;
        $this->translationValues = $this->getTranslationValues($languages, $rawValue);
        $this->type = $type;
        $this->value = $this->getValue($element, $rawValue);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $element;

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var mixed
     */
    public readonly mixed $input;

    /**
     * @var mixed
     */
    public readonly mixed $languages;

    /**
     * @var mixed
     */
    public readonly mixed $labelFor;

    /**
     * @var string
     */
    public readonly string $orientation;

    /**
     * @var string
     */
    public readonly string $type;

    /**
     * @var boolean
     */
    public readonly bool $translatable;

    /**
     * @var array<string,mixed>
     */
    public readonly array $translationValues;

    /**
     * @var mixed
     */
    public readonly mixed $value;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-element');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $element
     *
     * @return mixed
     */
    private function getId(mixed $element): mixed
    {
        return data_get($element, 'id');
    }

    /**
     * @param mixed $element
     *
     * @return mixed
     */
    private function getInput(mixed $element): mixed
    {
        return data_get($element, 'input');
    }

    /**
     * @param mixed $id
     * @param mixed $type
     *
     * @return mixed
     */
    private function getLabelFor(mixed $id, mixed $type): mixed
    {
        $labelFor = $id;

        if (in_array($type, ['combobox', 'select'], true))
        {
            $labelFor = null;
        }

        return $labelFor;
    }

    /**
     * @param mixed $input
     * @param mixed $type
     *
     * @return string
     */
    private function getOrientation(mixed $input, mixed $type): string
    {
        $orientation = 'vertical';

        if (
            $type === 'switch' ||
            ($type === 'checkbox' && empty(data_get($input, 'options')))
        )
        {
            $orientation = 'horizontal';
        }

        return $orientation;
    }

    /**
     * @param mixed $input
     *
     * @return string
     */
    private function getType(mixed $input): string
    {
        return (string) data_get($input, 'type', 'text');
    }

    /**
     * @param mixed $element
     * @param mixed $id
     * @param mixed $input
     * @param mixed $value
     *
     * @return mixed
     */
    private function getRawValue(mixed $id, mixed $input, mixed $value): mixed
    {
        return old($id, $value ?? data_get($input, 'defaultValue', ''));
    }

    /**
     * @param mixed $element
     * @param mixed $value
     *
     * @return mixed
     */
    private function getValue(mixed $element, mixed $value): mixed
    {
        if (data_get($element, 'translatable', false) && is_array($value))
        {
            return $value[app()->getLocale()] ?? '';
        }

        return $value;
    }

    /**
     * @param mixed $languages
     * @param mixed $value
     *
     * @return array<string,mixed>
     */
    private function getTranslationValues(mixed $languages, mixed $value): array
    {
        $translationValues = [];

        foreach ($languages as $language)
        {
            $languageValue = (string) data_get($language, 'value', '');

            if ($languageValue === '')
            {
                continue;
            }

            $translationValues[$languageValue] = '';

            if (is_array($value))
            {
                $translationValues[$languageValue] = $value[$languageValue] ?? '';
            }
            elseif ($languageValue === app()->getLocale())
            {
                $translationValues[$languageValue] = $value;
            }
        }

        if (is_array($value))
        {
            foreach ($value as $language => $languageValue)
            {
                $translationValues[(string) $language] = $languageValue;
            }
        }

        if (!$translationValues)
        {
            $translationValues[app()->getLocale()] = '';

            if (!is_array($value))
            {
                $translationValues[app()->getLocale()] = $value;
            }
        }

        return $translationValues;
    }

    #endregion
}
