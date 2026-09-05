<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ResourceForm extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $formData
     * @param mixed $form
     *
     * @return void
     */
    public function __construct(
        mixed $formData,
        mixed $form,
    )
    {
        $steps = $this->getSteps($form);

        $this->formData = $formData;
        $this->form = $form;
        $this->hasModel = data_get($formData, 'id') !== null;
        $this->sidebar = $this->getSidebar($steps);
        $this->steps = $this->getStandardSteps($steps);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $formData;

    /**
     * @var mixed
     */
    public readonly mixed $form;

    /**
     * @var boolean
     */
    public readonly bool $hasModel;

    /**
     * @var mixed
     */
    public readonly mixed $sidebar;

    /**
     * @var array
     */
    public readonly array $steps;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.resource-form');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param array $steps
     *
     * @return mixed
     */
    private function getSidebar(array $steps): mixed
    {
        return collect($steps)
            ->firstWhere('id', 'sidebar');
    }

    /**
     * @param array $steps
     *
     * @return array
     */
    private function getStandardSteps(array $steps): array
    {
        return collect($steps)
            ->reject(function ($step): bool
            {
                return ($step->id ?? null) === 'sidebar';
            })
            ->values()
            ->all();
    }

    /**
     * @param mixed $form
     *
     * @return array
     */
    private function getSteps(mixed $form): array
    {
        $steps = data_get($form, 'steps', []);

        return is_array($steps) ? $steps : [];
    }

    #endregion
}
