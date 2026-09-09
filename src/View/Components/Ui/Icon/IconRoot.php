<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Icon;

#region USE

use Illuminate\View\Component;
use Illuminate\View\View;
use InvalidArgumentException;

#endregion

final class IconRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string $name
     * @param string|null $title
     * @param string|null $fill
     *
     * @return void
     */
    public function __construct(string $name, ?string $title = null, ?string $fill = null)
    {
        $this->fill = $this->normalizeFill($fill);
        $this->name = self::resolveName($name);
        $this->title = $title;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $fill;

    /**
     * The icon name.
     *
     * @var string
     */
    public readonly string $name;

    /**
     * The accessible icon title.
     *
     * @var string|null
     */
    public readonly ?string $title;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return array<int,array<string,string>>
     */
    public static function getOptions(): array
    {
        static $options;

        if ($options !== null)
        {
            return $options;
        }

        $directory = dirname(__DIR__, 5) . '/resources/icons/fontawesome';
        $options = [];

        foreach (['brands', 'regular', 'solid'] as $style)
        {
            foreach (glob("{$directory}/{$style}/*.svg") ?: [] as $path)
            {
                $icon = pathinfo($path, PATHINFO_FILENAME);
                $name = "fa-{$style}-{$icon}";

                $options[] = [
                    'label' => view('narsil::components.icon-label', [
                        'icon' => $name,
                    ])->render(),
                    'searchLabel' => ucwords(str_replace('-', ' ', $icon)),
                    'value' => $name,
                ];
            }
        }

        usort(
            $options,
            static function (array $first, array $second): int
            {
                return strcasecmp($first['searchLabel'], $second['searchLabel']);
            },
        );

        return $options;
    }

    /**
     * Render the icon component.
     *
     * @return View
     */
    public function render(): View
    {
        $path = $this->getPath();

        return view('narsil::components.ui.icon.icon-root', [
            'svg' => $this->getSvg($path),
            'title' => $this->title,
        ]);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param string $name
     *
     * @return string
     */
    private static function resolveName(string $name): string
    {
        if (!preg_match('/^fa-(solid|regular|brands)-[a-z0-9-]+$/', $name))
        {
            throw new InvalidArgumentException("Invalid icon name: {$name}");
        }

        return $name;
    }

    /**
     * @return string
     */
    private function getPath(): string
    {
        preg_match('/^fa-(solid|regular|brands)-(.+)$/', $this->name, $matches);

        $directory = dirname(__DIR__, 5) . '/resources/icons/fontawesome';
        $path = "{$directory}/{$matches[1]}/{$matches[2]}.svg";

        if (!is_file($path) && $matches[1] === 'regular')
        {
            $path = "{$directory}/solid/{$matches[2]}.svg";
        }

        return $path;
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function getSvg(string $path): string
    {
        return (string) file_get_contents($path);
    }

    /**
     * @param string|null $fill
     *
     * @return string
     */
    private function normalizeFill(?string $fill): string
    {
        return filled($fill) ? $fill : 'currentColor';
    }

    #endregion
}
