<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\File;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FileUpload extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $icon
     *
     * @return void
     */
    public function __construct(
        mixed $icon = 'upload'
    )
    {
        $this->icon = $icon;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $icon;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.file.file-upload');
    }

    #endregion
}
