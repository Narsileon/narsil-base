<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputArray extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $input
     * @param mixed $id
     * @param mixed $languages
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $input,
        mixed $id,
        mixed $languages = [],
        mixed $value = []
    )
    {
        $items = $this->normalizeItems($value);
        $itemLabels = $this->getItemLabels($items, $input);

        $this->element = $element;
        $this->hasItems = $this->hasItems($items);
        $this->id = $id;
        $this->input = $input;
        $this->itemLabels = $itemLabels;
        $this->items = $items;
        $this->languages = $languages;
        $this->name = $this->getName($id);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $element;

    /**
     * @var boolean
     */
    public readonly bool $hasItems;

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var mixed
     */
    public readonly mixed $input;

    /**
     * @var array<int,string>
     */
    public readonly array $itemLabels;

    /**
     * @var array<int,mixed>
     */
    public readonly array $items;

    /**
     * @var mixed
     */
    public readonly mixed $languages;

    /**
     * @var string
     */
    public readonly string $name;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.input.input-array');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param array<int,mixed> $items
     * @param mixed $input
     *
     * @return array<int,string>
     */
    private function getItemLabels(array $items, mixed $input): array
    {
        $labelPath = (string) ($input->labelPath ?? 'label');
        $labels = [];

        foreach ($items as $index => $item)
        {
            $label = data_get($item, $labelPath);

            if (is_array($label) || is_object($label))
            {
                $translations = (array) $label;
                $label = $translations[app()->getLocale()] ?? reset($translations);
            }

            if ($label instanceof \Stringable)
            {
                $label = (string) $label;
            }

            if (is_scalar($label) && (string) $label !== '')
            {
                $labels[] = (string) $label;
            }
            else
            {
                $labels[] = (string) ($index + 1);
            }
        }

        return $labels;
    }

    /**
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
     * @param array<int,mixed> $items
     *
     * @return boolean
     */
    private function hasItems(array $items): bool
    {
        return count($items) > 0;
    }

    /**
     * @param mixed $value
     *
     * @return array<int,mixed>
     */
    private function normalizeItems(mixed $value): array
    {
        return is_array($value) ? array_values($value) : [];
    }

    #endregion
}
