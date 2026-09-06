<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormBlame extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $data
     *
     * @return void
     */
    public function __construct(mixed $data = [])
    {
        $this->createdAt = data_get($data, 'created_at');
        $this->creator = data_get($data, 'creator.full_name');
        $this->editor = data_get($data, 'editor.full_name') ?: $this->creator;
        $this->updatedAt = data_get($data, 'updated_at');
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $createdAt;

    /**
     * @var mixed
     */
    public readonly mixed $creator;

    /**
     * @var mixed
     */
    public readonly mixed $editor;

    /**
     * @var mixed
     */
    public readonly mixed $updatedAt;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-blame');
    }

    #endregion
}
