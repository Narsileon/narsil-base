<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputTree extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string $id
     * @param string $name
     * @param boolean $rootExclusive
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        string $id,
        string $name,
        mixed $value = [],
        bool $rootExclusive = false,
    )
    {
        $this->id = $id;
        $this->items = $this->flattenItems(is_array($value) ? $value : []);
        $this->name = $name;
        $this->rootExclusive = $rootExclusive;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $id;

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $items;

    /**
     * @var string
     */
    public readonly string $name;

    /**
     * @var boolean
     */
    public readonly bool $rootExclusive;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.input.input-tree');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param array<int,mixed> $items
     * @param mixed $parentId
     * @param integer $depth
     *
     * @return array<int,array<string,mixed>>
     */
    private function flattenItems(array $items, mixed $parentId = null, int $depth = 0): array
    {
        $flattenedItems = [];

        foreach ($items as $item)
        {
            if (!is_array($item) || !array_key_exists('id', $item))
            {
                continue;
            }

            $children = $item['children'] ?? [];
            $item['depth'] = $depth;
            $item['parent_id'] = $parentId;
            unset($item['children']);
            $flattenedItems[] = $item;

            if (is_array($children))
            {
                $flattenedItems = [
                    ...$flattenedItems,
                    ...$this->flattenItems($children, $item['id'], $depth + 1),
                ];
            }
        }

        return $flattenedItems;
    }

    #endregion
}
