<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormTabs extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $formData
     * @param mixed $languages
     * @param mixed $sidebar
     * @param mixed $steps
     * @param mixed $defaultLanguage
     *
     * @return void
     */
    public function __construct(
        mixed $formData = [],
        mixed $languages = [],
        mixed $steps = [],
        mixed $sidebar = null,
        mixed $defaultLanguage = null
    ) {
        $this->defaultLanguage = $defaultLanguage;
        $this->formData = $formData;
        $this->hasBlameData = data_get($formData, 'created_at') || data_get($formData, 'updated_at');
        $this->languages = $languages;
        $this->sidebar = $sidebar;
        $this->steps = $this->getSteps($formData, $steps, $sidebar);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $defaultLanguage;

    /**
     * @var mixed
     */
    public readonly mixed $formData;

    /**
     * @var boolean
     */
    public readonly bool $hasBlameData;

    /**
     * @var mixed
     */
    public readonly mixed $languages;

    /**
     * @var mixed
     */
    public readonly mixed $sidebar;

    /**
     * @var mixed
     */
    public readonly mixed $steps;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-tabs');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $formData
     * @param mixed $steps
     * @param mixed $sidebar
     *
     * @return array<int,array<string,mixed>>
     */
    private function getSteps(mixed $formData, mixed $steps, mixed $sidebar): array
    {
        $sourceSteps = [];

        if (is_iterable($steps))
        {
            foreach ($steps as $step)
            {
                $sourceSteps[] = $step;
            }
        }

        if ($sidebar)
        {
            $sourceSteps[] = $sidebar;
        }

        $resolvedSteps = [];

        foreach ($sourceSteps as $step)
        {
            $stepId = data_get($step, 'id');
            $elements = [];
            $stepElements = data_get($step, 'elements', []);

            if (is_iterable($stepElements))
            {
                foreach ($stepElements as $element)
                {
                    $elementId = data_get($element, 'id');
                    $nestedElements = data_get($element, 'elements');

                    $elements[] = [
                        'element' => $element,
                        'id' => $elementId,
                        'isFieldset' => is_iterable($nestedElements),
                        'value' => data_get($formData, $elementId),
                    ];
                }
            }

            $resolvedSteps[] = [
                'elements' => $elements,
                'id' => $stepId,
                'isSidebar' => $stepId === 'sidebar',
                'label' => data_get($step, 'label', ''),
            ];
        }

        return $resolvedSteps;
    }

    #endregion
}
