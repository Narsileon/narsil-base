<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\ToggleGroup;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ToggleGroupItem extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $value
     * @param mixed $size
     * @param mixed $variant
     * @param string $changeEvent
     *
     * @return void
     */
    public function __construct(
        mixed $value,
        mixed $size = null,
        mixed $variant = null,
        string $changeEvent = 'toggle-group-change'
    )
    {
        $this->changeEvent = $changeEvent;
        $this->size = $this->normalizeValue($size);
        $this->value = $value;
        $this->variant = $this->normalizeValue($variant);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $changeEvent;

    /**
     * @var mixed
     */
    public readonly mixed $size;

    /**
     * @var mixed
     */
    public readonly mixed $value;

    /**
     * @var mixed
     */
    public readonly mixed $variant;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.toggle-group.toggle-group-item');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    private function normalizeValue(mixed $value): mixed
    {
        return $value ?: null;
    }

    #endregion
}
