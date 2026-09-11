<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ResourceModal extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string $title
     * @param string $url
     *
     * @return void
     */
    public function __construct(string $title, string $url)
    {
        $this->title = $title;
        $this->url = $url;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $title;

    /**
     * @var string
     */
    public readonly string $url;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.resource-modal.root');
    }

    #endregion
}
