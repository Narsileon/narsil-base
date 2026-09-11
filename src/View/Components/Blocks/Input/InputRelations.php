<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputRelations extends Component
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
    public function __construct(mixed $element, mixed $input, mixed $id, mixed $languages = [], mixed $value = [])
    {
        $this->id = (string) $id;
        $this->input = $input;
        $this->languages = $languages;
        $this->value = $value ?? [];
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $id;

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
    public readonly mixed $value;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.input.input-relations');
    }

    #endregion
}
