<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Icon;

#region USE

use Illuminate\View\Component;
use Illuminate\View\View;
use InvalidArgumentException;

#endregion

final class Root extends Component
{
    #region CONSTRUCTOR

    /**
     * Create an icon component.
     *
     * @param string $name
     * @param string|null $title
     *
     * @return void
     */
    public function __construct(string $name, ?string $title = null)
    {
        $this->name = self::resolveName($name);
        $this->title = $title;
    }

    #endregion

    #region CONSTANTS

    /**
     * The logical icon name to Font Awesome name mappings.
     *
     * @var array<string,string>
     */
    private const ICONS = [
        'block' => 'fa-solid-cubes-stacked',
        'chart-pie' => 'fa-solid-chart-pie',
        'chevron-left' => 'fa-solid-chevron-left',
        'chevron-right' => 'fa-solid-chevron-right',
        'chevron-up' => 'fa-regular-chevron-up',
        'cloud' => 'fa-solid-cloud',
        'field' => 'fa-solid-list',
        'fieldset' => 'fa-solid-list-squares',
        'footer' => 'fa-solid-window-maximize',
        'form' => 'fa-solid-clipboard-list',
        'header' => 'fa-solid-header',
        'horizon' => 'fa-solid-gauge-high',
        'input' => 'fa-solid-square-pen',
        'layers' => 'fa-solid-layer-group',
        'permission' => 'fa-solid-shield',
        'redo' => 'fa-solid-redo',
        'role' => 'fa-solid-user-shield',
        'save' => 'fa-regular-save',
        'server' => 'fa-solid-server',
        'template' => 'fa-solid-window-restore',
        'user' => 'fa-solid-user',
        'user-edit' => 'fa-solid-user-edit',
        'shield' => 'fa-solid-shield',
        'upload' => 'fa-solid-upload',
        'bars' => 'fa-regular-bars',
        'check' => 'fa-regular-check',
        'chevron-down' => 'fa-regular-chevron-down',
        'chevrons-up-down' => 'fa-regular-arrows-up-down',
        'circle-check' => 'fa-regular-circle-check',
        'circle-user' => 'fa-regular-circle-user',
        'copy' => 'fa-regular-copy',
        'edit' => 'fa-regular-edit',
        'email' => 'fa-regular-envelope',
        'eye-off' => 'fa-regular-eye-slash',
        'eye' => 'fa-regular-eye',
        'filter' => 'fa-regular-filter',
        'globe' => 'fa-solid-globe',
        'image' => 'fa-regular-image',
        'log-in' => 'fa-regular-right-to-bracket',
        'log-out' => 'fa-regular-right-from-bracket',
        'moon' => 'fa-regular-moon',
        'more-horizontal' => 'fa-regular-ellipsis',
        'plus' => 'fa-regular-plus',
        'search' => 'fa-regular-search',
        'settings' => 'fa-regular-gear',
        'star' => 'fa-solid-star',
        'star-off' => 'fa-regular-star',
        'star-outline' => 'fa-regular-star',
        'sun-moon' => 'fa-regular-circle-half-stroke',
        'sun' => 'fa-regular-sun',
        'trash' => 'fa-regular-trash',
        'x' => 'fa-regular-x',
    ];

    #endregion

    #region PROPERTIES

    /**
     * The icon name.
     *
     * @var string
     */
    public string $name;

    /**
     * The accessible icon title.
     *
     * @var string|null
     */
    public ?string $title;

    #endregion

    #region PUBLIC METHODS

    /**
     * Render the icon component.
     *
     * @return View
     */
    public function render(): View
    {
        preg_match('/^fa-(solid|regular|brands)-(.+)$/', $this->name, $matches);

        $directory = dirname(__DIR__, 5) . '/resources/icons/fontawesome';
        $path = "{$directory}/{$matches[1]}/{$matches[2]}.svg";

        if (!is_file($path) && $matches[1] === 'regular')
        {
            $path = "{$directory}/solid/{$matches[2]}.svg";
        }

        return view('narsil::components.ui.icon.root', [
            'path' => $path,
            'title' => $this->title,
        ]);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Resolve and validate a logical or Font Awesome icon name.
     *
     * @param string $name
     *
     * @return string
     */
    private static function resolveName(string $name): string
    {
        $resolvedName = self::ICONS[$name] ?? $name;

        if (!preg_match('/^fa-(solid|regular|brands)-[a-z0-9-]+$/', $resolvedName))
        {
            throw new InvalidArgumentException("Invalid icon name: {$name}");
        }

        return $resolvedName;
    }

    #endregion
}
