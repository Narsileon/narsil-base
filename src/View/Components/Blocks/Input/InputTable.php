<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputTable extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $input
     * @param mixed $id
     * @param mixed $languages
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $input,
        mixed $id,
        mixed $languages = [],
        mixed $value = []
    ) {
        $this->element = $element;
        $this->id = $id;
        $this->input = $input;
        $this->languages = $languages;
        $this->name = $this->getName($id);

        $rows = [];

        if (is_array($value))
        {
            $rows = array_values($value);
        }

        $rowData = $this->getRowData($rows, $input);

        $this->rowUuids = $rowData['rowUuids'];
        $this->rowValues = $rowData['rowValues'];
        $this->rows = $rows;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $element;

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var mixed
     */
    public readonly mixed $input;

    /**
     * @var mixed
     */
    public readonly mixed $languages;

    /**
     * @var string
     */
    public readonly string $name;

    /**
     * @var array<int,mixed>
     */
    public readonly array $rows;

    /**
     * @var array<int,mixed>
     */
    public readonly array $rowUuids;

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $rowValues;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.input.input-table');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $id
     *
     * @return string
     */
    private function getName(mixed $id): string
    {
        $parts = explode('.', (string) $id);
        $name = (string) array_shift($parts);

        foreach ($parts as $part)
        {
            $name .= "[$part]";
        }

        return $name;
    }

    /**
     * @param array<int,mixed> $rows
     * @param mixed $input
     *
     * @return array{rowUuids:array<int,mixed>,rowValues:array<int,array<string,mixed>>}
     */
    private function getRowData(array $rows, mixed $input): array
    {
        $rowUuids = [];
        $rowValues = [];

        foreach ($rows as $index => $row)
        {
            $rowUuids[$index] = data_get($row, 'uuid', 'row-' . $index);

            foreach ($input->columns ?? [] as $column)
            {
                $columnId = $column->id;
                $defaultValue = data_get($column, 'input.defaultValue');
                $rowValues[$index][$columnId] = data_get($row, $columnId, $defaultValue);
            }
        }

        return [
            'rowUuids' => $rowUuids,
            'rowValues' => $rowValues,
        ];
    }

    #endregion
}
