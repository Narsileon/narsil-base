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
     * @param mixed $id
     * @param boolean $bare
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $languages = [],
        mixed $value = null,
        mixed $id = null,
        bool $bare = false
    )
    {
        $input = $this->getInput($element);
        $resolvedId = $id ?? $this->getId($element);
        $resolvedElement = $this->withId($element, $resolvedId);
        $type = $this->getType($input);
        $translatable = (bool) data_get($element, 'translatable', false);
        $rawValue = $this->getRawValue($resolvedId, $input, $value);

        $this->element = $resolvedElement;
        $this->id = $resolvedId;
        $this->input = $input;
        $this->labelFor = $this->getLabelFor($resolvedId, $type);
        $this->orientation = $this->getOrientation($input, $type);
        $this->languages = $languages;
        $this->name = $this->getName($resolvedId);
        $this->bare = $bare;
        $this->translatable = $translatable;
        $this->translationValues = $this->getTranslationValues($languages, $rawValue);
        $this->type = $type;
        $this->value = $this->getValue($resolvedElement, $rawValue);
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
     * @var string
     */
    public readonly string $name;

    /**
     * @var boolean
     */
    public readonly bool $bare;

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
     * Convert a dotted field path to a Laravel form name.
     *
     * @param mixed $id
     *
     * @return string
     */
    private function getName(mixed $id): string
    {
        $parts = explode('.', (string) $id);
        $name = (string) array_shift($parts);

        foreach ($parts as $part)
        {
            $name .= "[$part]";
        }

        return $name;
    }

    /**
     * Apply a nested field path to a form element without changing the form definition.
     *
     * @param mixed $element
     * @param mixed $id
     *
     * @return mixed
     */
    private function withId(mixed $element, mixed $id): mixed
    {
        if (data_get($element, 'id') === $id)
        {
            return $element;
        }

        if (is_array($element))
        {
            $element['id'] = $id;

            return $element;
        }

        if (is_object($element))
        {
            $resolvedElement = clone $element;
            $resolvedElement->id = $id;

            return $resolvedElement;
        }

        return $element;
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

        if (in_array($type, ['combobox', 'link', 'select'], true))
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
        $defaultValue = $value ?? data_get($input, 'defaultValue', '');

        $reloadValue = request()->header('X-Narsil-Form-Reload') === 'true'
            ? request()->query($id, $defaultValue)
            : $defaultValue;

        return old($id, $reloadValue);
    }

    /**
     * @param mixed $element
     * @param mixed $value
     *
     * @return mixed
     */
    private function getValue(mixed $element, mixed $value): mixed
    {
        if (data_get($element, 'translatable', false) && (is_array($value) || is_object($value)))
        {
            $translations = (array) $value;

            return $translations[app()->getLocale()] ?? '';
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
        $translations = null;

        if (is_array($value) || is_object($value))
        {
            $translations = (array) $value;
        }

        foreach ($languages as $language)
        {
            $languageValue = (string) data_get($language, 'value', '');

            if ($languageValue === '')
            {
                continue;
            }

            $translationValues[$languageValue] = '';

            if ($translations !== null)
            {
                $translationValues[$languageValue] = $translations[$languageValue] ?? '';
            }
            elseif ($languageValue === app()->getLocale())
            {
                $translationValues[$languageValue] = $value;
            }
        }

        if ($translations !== null)
        {
            foreach ($translations as $language => $languageValue)
            {
                $translationValues[(string) $language] = $languageValue;
            }
        }

        if (!$translationValues)
        {
            $translationValues[app()->getLocale()] = '';

            if ($translations === null)
            {
                $translationValues[app()->getLocale()] = $value;
            }
        }

        return $translationValues;
    }

    #endregion
}
