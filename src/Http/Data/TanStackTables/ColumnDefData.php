<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data\TanStackTables;

#region USE

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use InvalidArgumentException;
use JsonSerializable;
use Narsil\Base\Enums\OperatorEnum;
use Narsil\Base\Helpers\Translator;
use Narsil\Base\Http\Data\Forms\Inputs\CheckboxInputData;
use Narsil\Base\Http\Data\Forms\Inputs\DateInputData;
use Narsil\Base\Http\Data\Forms\Inputs\DatetimeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\MonthInputData;
use Narsil\Base\Http\Data\Forms\Inputs\NumberInputData;
use Narsil\Base\Http\Data\Forms\Inputs\RangeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\SwitchInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TimeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\WeekInputData;

#endregion

readonly class ColumnDefData implements Arrayable, JsonSerializable
{
    #region CONSTRUCTOR

    /**
     * @param string $id
     * @param string $type
     * @param string|null $accessorKey
     * @param string|null $header
     * @param boolean $enableColumnFilter
     * @param boolean $visibility
     *
     * @return void
     */
    public function __construct(
        string $id,
        string $type,
        ?string $accessorKey = null,
        ?string $header = null,
        bool $enableColumnFilter = true,
        bool $visibility = false,
    )
    {
        $this->enableColumnFilter = $enableColumnFilter;
        $this->accessorKey = $accessorKey ?: $id;
        $this->header = $header ?: $this->getHeader($id);
        $this->id = $id;
        $this->meta = [
            'operators' => $this->getOperators($type),
            'type' => $type,
        ];
        $this->type = $type;
        $this->visibility = $visibility;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var boolean
     */
    public bool $enableColumnFilter;

    /**
     * @var string
     */
    public string $accessorKey;

    /**
     * @var string
     */
    public string $header;

    /**
     * @var string
     */
    public string $id;

    /**
     * @var array<string,mixed>
     */
    public array $meta;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var boolean
     */
    public bool $visibility;

    #endregion

    #region PUBLIC METHODS

    /**
     * @param string $id
     * @param string|null $type
     * @param string|null $accessorKey
     * @param string|null $header
     * @param boolean $enableColumnFilter
     * @param boolean $visibility
     *
     * @return static
     */
    public static function make(
        string $id,
        ?string $type = null,
        ?string $accessorKey = null,
        ?string $header = null,
        bool $enableColumnFilter = true,
        bool $visibility = false,
    ): static
    {
        $type ??= static::type();

        return new static(
            id: $id,
            type: $type,
            accessorKey: $accessorKey,
            header: $header,
            enableColumnFilter: $enableColumnFilter,
            visibility: $visibility,
        );
    }

    /**
     * @param string $id
     * @param string|null $accessorKey
     * @param string|null $header
     * @param boolean $enableColumnFilter
     * @param boolean $visibility
     *
     * @return self
     */
    public static function number(
        string $id,
        ?string $accessorKey = null,
        ?string $header = null,
        bool $enableColumnFilter = true,
        bool $visibility = false,
    ): self
    {
        return self::make(
            id: $id,
            type: NumberInputData::TYPE,
            accessorKey: $accessorKey,
            header: $header,
            enableColumnFilter: $enableColumnFilter,
            visibility: $visibility,
        );
    }

    /**
     * @return self
     */
    public function filterable(): self
    {
        return $this->with(enableColumnFilter: true);
    }

    /**
     * @return self
     */
    public function hidden(): self
    {
        return $this->with(visibility: false);
    }

    /**
     * @return array<string,mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @param string $header
     *
     * @return self
     */
    public function label(string $header): self
    {
        return $this->with(header: $header);
    }

    /**
     * @return self
     */
    public function notFilterable(): self
    {
        return $this->with(enableColumnFilter: false);
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'accessorKey' => $this->accessorKey,
            'enableColumnFilter' => $this->enableColumnFilter,
            'header' => $this->header,
            'id' => $this->id,
            'meta' => $this->meta,
            'visibility' => $this->visibility,
        ];
    }

    /**
     * @return self
     */
    public function visible(): self
    {
        return $this->with(visibility: true);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return string
     */
    protected static function type(): string
    {
        throw new InvalidArgumentException('A column type is required.');
    }

    /**
     * @param string $column
     *
     * @return string
     */
    protected function getHeader(string $column): string
    {
        if (Str::endsWith($column, '_id'))
        {
            $column = Str::replace('_id', '', $column);
        }

        $key = "validation.attributes.$column";
        $translation = Translator::trans($key);

        if ($translation === $key)
        {
            return $column;
        }

        return Str::ucfirst($translation);
    }

    /**
     * @param string $type
     *
     * @return array<int,array<string,string>>
     */
    protected function getOperators(string $type): array
    {
        return match ($type)
        {
            CheckboxInputData::TYPE, SwitchInputData::TYPE => [
                OperatorEnum::option(OperatorEnum::EQUALS),
                OperatorEnum::option(OperatorEnum::NOT_EQUALS),
            ],
            DateInputData::TYPE,
            DatetimeInputData::TYPE,
            MonthInputData::TYPE,
            TimeInputData::TYPE,
            WeekInputData::TYPE => [
                OperatorEnum::option(OperatorEnum::EQUALS),
                OperatorEnum::option(OperatorEnum::NOT_EQUALS),
                OperatorEnum::option(OperatorEnum::BEFORE),
                OperatorEnum::option(OperatorEnum::BEFORE_OR_EQUAL),
                OperatorEnum::option(OperatorEnum::AFTER),
                OperatorEnum::option(OperatorEnum::AFTER_OR_EQUAL),
            ],
            NumberInputData::TYPE, RangeInputData::TYPE => [
                OperatorEnum::option(OperatorEnum::EQUALS),
                OperatorEnum::option(OperatorEnum::NOT_EQUALS),
                OperatorEnum::option(OperatorEnum::GREATER_THAN),
                OperatorEnum::option(OperatorEnum::GREATER_THAN_OR_EQUAL),
                OperatorEnum::option(OperatorEnum::LESS_THAN),
                OperatorEnum::option(OperatorEnum::LESS_THAN_OR_EQUAL),
            ],
            default => [
                OperatorEnum::option(OperatorEnum::EQUALS),
                OperatorEnum::option(OperatorEnum::NOT_EQUALS),
                OperatorEnum::option(OperatorEnum::CONTAINS),
                OperatorEnum::option(OperatorEnum::NOT_CONTAINS),
                OperatorEnum::option(OperatorEnum::STARTS_WITH),
                OperatorEnum::option(OperatorEnum::ENDS_WITH),
                OperatorEnum::option(OperatorEnum::DOESNT_START_WITH),
                OperatorEnum::option(OperatorEnum::DOESNT_END_WITH),
            ],
        };
    }

    /**
     * @param boolean|null $enableColumnFilter
     * @param string|null $header
     * @param boolean|null $visibility
     *
     * @return static
     */
    protected function with(
        ?bool $enableColumnFilter = null,
        ?string $header = null,
        ?bool $visibility = null,
    ): static
    {
        return new static(
            id: $this->id,
            type: $this->type,
            accessorKey: $this->accessorKey,
            header: $header ?? $this->header,
            enableColumnFilter: $enableColumnFilter ?? $this->enableColumnFilter,
            visibility: $visibility ?? $this->visibility,
        );
    }

    #endregion
}
