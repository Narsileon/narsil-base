<?php

declare(strict_types=1);

namespace Narsil\Base\Contracts;

#region USE

use Narsil\Base\Enums\ModelOperationEnum;

#endregion

interface ModelDefinition
{
    #region PUBLIC METHODS

    /**
     * @return string
     */
    public function model(): string;

    /**
     * @return string|null
     */
    public function form(): ?string;

    /**
     * @return string[]
     */
    public function indexWith(): array;

    /**
     * @return string[]
     */
    public function indexWithCount(): array;

    /**
     * @return string[]
     */
    public function editWith(): array;

    /**
     * @return ModelOperationEnum[]
     */
    public function operations(): array;

    /**
     * @return string|null
     */
    public function request(): ?string;

    /**
     * @return string|null
     */
    public function replicateAction(): ?string;

    /**
     * @return string
     */
    public function route(): string;

    #endregion
}
