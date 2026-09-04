<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Requests;

#region USE

use Illuminate\Foundation\Http\FormRequest;
use Narsil\Base\Contracts\Requests\TanStackTableFormRequest as Contract;
use Narsil\Base\Models\Users\TanStackTable;
use Narsil\Base\Validation\FormRule;

#endregion

class TanStackTableFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            TanStackTable::COLUMN_FILTERS => [
                FormRule::ARRAY,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
            TanStackTable::COLUMN_ORDER => [
                FormRule::ARRAY,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
            TanStackTable::COLUMN_VISIBILITY => [
                FormRule::ARRAY,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
            TanStackTable::GLOBAL_FILTER => [
                FormRule::STRING,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
            TanStackTable::NAME => [
                FormRule::STRING,
                FormRule::SOMETIMES,
            ],
            TanStackTable::PAGE_SIZE => [
                FormRule::INTEGER,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
            TanStackTable::PRESET_UUID => [
                FormRule::STRING,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
            TanStackTable::ROW_SELECTION => [
                FormRule::ARRAY,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
            TanStackTable::SORTING => [
                FormRule::ARRAY,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
        ];
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Decode the JSON state submitted by the Blade data table.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $attributes = [];

        foreach ([
            TanStackTable::COLUMN_FILTERS,
            TanStackTable::COLUMN_ORDER,
            TanStackTable::COLUMN_VISIBILITY,
            TanStackTable::ROW_SELECTION,
            TanStackTable::SORTING,
        ] as $key)
        {
            $value = $this->input($key);

            if (is_string($value))
            {
                $attributes[$key] = json_decode($value, true) ?: [];
            }
        }

        $this->merge($attributes);
    }

    #endregion
}
