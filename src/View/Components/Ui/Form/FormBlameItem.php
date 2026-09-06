<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormBlameItem extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $date
     * @param mixed $label
     * @param mixed $name
     *
     * @return void
     */
    public function __construct(
        mixed $date,
        mixed $label,
        mixed $name = null
    )
    {
        $this->date = (string) $date;
        $this->label = (string) $label;

        if ($name !== null)
        {
            $this->name = (string) $name;
        }
        else
        {
            $this->name = null;
        }
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $date;

    /**
     * @var string
     */
    public readonly string $label;

    /**
     * @var string|null
     */
    public readonly ?string $name;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-blame-item');
    }

    #endregion
}
