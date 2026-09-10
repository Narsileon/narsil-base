<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputTable extends Component
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
        $this->element = $element;
        $this->id = $id;
        $this->input = $input;
        $this->languages = $languages;
        $this->name = $this->getName($id);

        $rows = [];

        if (is_array($value))
        {
            $rows = array_values($value);
        }

        $this->rows = $rows;
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
     * @var array<int,mixed>
     */
    public readonly array $rows;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.input.input-table');
    }

    #endregion

    #region PRIVATE METHODS

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

    #endregion
}
