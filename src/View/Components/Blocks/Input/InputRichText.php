<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\Component;

#endregion

final class InputRichText extends Component
{
    #region CONSTRUCTOR

    public function __construct(
        mixed $element,
        mixed $id,
        mixed $input,
        mixed $languages = [],
        mixed $name = null,
        mixed $value = null,
    ) {
        $modules = Arr::get($input, 'modules', []);
        $resolvedValue = $value ?? Arr::get($input, 'defaultValue', '');

        $this->id = $id;
        $this->name = (string) ($name ?? $id);
        $this->value = $this->getValue($resolvedValue);
        $this->placeholder = (string) Arr::get($input, 'placeholder', '');
        $this->modules = $this->getModules($modules);
        $this->readOnly = (bool) Arr::get($element, 'readOnly', false);
        $this->required = (bool) Arr::get($element, 'required', false);
        $this->translatable = (bool) Arr::get($element, 'translatable', false);
        $this->toolbarGroups = $this->getToolbarGroups();
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var string[]
     */
    public readonly array $modules;

    /**
     * @var string
     */
    public readonly string $name;

    /**
     * @var string
     */
    public readonly string $placeholder;

    /**
     * @var boolean
     */
    public readonly bool $readOnly;

    /**
     * @var boolean
     */
    public readonly bool $required;

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $toolbarGroups;

    /**
     * @var boolean
     */
    public readonly bool $translatable;

    /**
     * @var string
     */
    public readonly string $value;

    #endregion

    #region PUBLIC METHODS

    public function hasModule(string $module): bool
    {
        if ($this->modules === [])
        {
            $hasModule = true;
        }
        elseif ($module === 'justify')
        {
            $hasModule = in_array('justify', $this->modules, true)
                || in_array('align_justify', $this->modules, true);
        }
        else
        {
            $hasModule = in_array($module, $this->modules, true);
        }

        return $hasModule;
    }

    public function render(): View
    {
        return view('narsil::components.blocks.input.input-rich-text');
    }

    #endregion

    #region PRIVATE METHODS

    private function control(
        string $module,
        string $label,
        string $icon,
        string $command,
        ?string $active,
        bool $disabled = false,
        ?string $argument = null,
    ): array {
        if ($command === 'setTextAlign')
        {
            $activeExpression = "isActive('textAlign', { textAlign: '$argument' })";
        }
        elseif ($active !== null)
        {
            $activeExpression = "isActive('$active')";
        }
        else
        {
            $activeExpression = null;
        }

        if ($activeExpression !== null)
        {
            $stateExpression = "$activeExpression ? 'on' : 'off'";
        }
        else
        {
            $activeExpression = 'undefined';
            $stateExpression = "'off'";
        }

        if ($disabled)
        {
            $disabledExpression = "!can('$command')";
        }
        else
        {
            $disabledExpression = 'false';
        }

        if ($argument !== null)
        {
            $handler = "$command('$argument')";
        }
        else
        {
            $handler = "$command()";
        }

        return [
            'activeExpression' => $activeExpression,
            'command' => $command,
            'disabledExpression' => $disabledExpression,
            'handler' => $handler,
            'icon' => $icon,
            'label' => Lang::get("narsil::rich-text-editor.$label"),
            'module' => $module,
            'stateExpression' => $stateExpression,
        ];
    }

    private function getModules(mixed $modules): array
    {
        if (is_array($modules))
        {
            $resolvedModules = $modules;
        }
        else
        {
            $resolvedModules = [];
        }

        return $resolvedModules;
    }

    private function getToolbarGroups(): array
    {
        $groups = [
            [
                'type' => 'controls',
                'controls' => [
                    $this->control('bold', 'bold', 'fa-solid-bold', 'toggleBold', 'bold'),
                    $this->control('italic', 'italic', 'fa-solid-italic', 'toggleItalic', 'italic'),
                    $this->control('underline', 'underline', 'fa-solid-underline', 'toggleUnderline', 'underline'),
                    $this->control('strike', 'strike', 'fa-solid-strikethrough', 'toggleStrike', 'strike'),
                ],
            ],
            [
                'type' => 'controls',
                'controls' => [
                    $this->control('superscript', 'superscript', 'fa-solid-superscript', 'toggleSuperscript', 'superscript'),
                    $this->control('subscript', 'subscript', 'fa-solid-subscript', 'toggleSubscript', 'subscript'),
                ],
            ],
            [
                'type' => 'headings',
                'levels' => [],
            ],
            [
                'type' => 'controls',
                'controls' => [
                    $this->control('align_left', 'align_left', 'fa-solid-align-left', 'setTextAlign', null, false, 'left'),
                    $this->control('align_center', 'align_center', 'fa-solid-align-center', 'setTextAlign', null, false, 'center'),
                    $this->control('align_right', 'align_right', 'fa-solid-align-right', 'setTextAlign', null, false, 'right'),
                    $this->control('justify', 'justify', 'fa-solid-align-justify', 'setTextAlign', null, false, 'justify'),
                ],
            ],
            [
                'type' => 'controls',
                'controls' => [
                    $this->control('bullet_list', 'bullet_list', 'fa-solid-list-ul', 'toggleBulletList', 'bulletList'),
                    $this->control('ordered_list', 'ordered_list', 'fa-solid-list-ol', 'toggleOrderedList', 'orderedList'),
                ],
            ],
            [
                'type' => 'controls',
                'controls' => [
                    $this->control('undo', 'undo', 'fa-solid-undo', 'undo', null, true),
                    $this->control('redo', 'redo', 'fa-solid-redo', 'redo', null, true),
                ],
            ],
        ];

        $filteredGroups = [];

        foreach ($groups as $group)
        {
            if ($group['type'] === 'headings')
            {
                foreach (range(1, 6) as $level)
                {
                    if ($this->hasModule("heading_$level"))
                    {
                        $group['levels'][] = $level;
                    }
                }

                if ($group['levels'] !== [])
                {
                    $filteredGroups[] = $group;
                }
            }
            else
            {
                $controls = [];

                foreach ($group['controls'] as $control)
                {
                    if ($this->hasModule($control['module']))
                    {
                        $controls[] = $control;
                    }
                }

                if ($controls !== [])
                {
                    $group['controls'] = $controls;
                    $filteredGroups[] = $group;
                }
            }
        }

        return $filteredGroups;
    }

    private function getValue(mixed $value): string
    {
        if (is_scalar($value))
        {
            $resolvedValue = (string) $value;
        }
        else
        {
            $resolvedValue = '';
        }

        return $resolvedValue;
    }

    #endregion
}
