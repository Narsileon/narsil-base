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
    #region CONSTANTS

    /**
     * The logical icon name to Font Awesome name mappings.
     *
     * @var array<string,string>
     */
    private const ICONS = [
        'bars' => 'fa-regular-bars',
        'check' => 'fa-regular-check',
        'chevron-down' => 'fa-regular-chevron-down',
        'log-in' => 'fa-regular-right-to-bracket',
        'log-out' => 'fa-regular-right-from-bracket',
        'moon' => 'fa-regular-moon',
        'settings' => 'fa-regular-gear',
        'sun' => 'fa-regular-sun',
        'sun-moon' => 'fa-regular-circle-half-stroke',
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
