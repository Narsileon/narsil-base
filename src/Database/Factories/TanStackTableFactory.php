<?php

declare(strict_types=1);

namespace Narsil\Base\Database\Factories;

#region USE

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Narsil\Base\Models\Users\TanStackTable;

#endregion

class TanStackTableFactory extends Factory
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function definition(): array
    {
        return [
            TanStackTable::SORTING => [
                [
                    'id' => TanStackTable::UPDATED_AT,
                    'desc' => true
                ],
            ],
            TanStackTable::TABLE_NAME => Str::snake($this->faker->slug(1)),
        ];
    }

    #endregion
}
