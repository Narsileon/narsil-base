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
     * @return string[]
     */
    public function editWith(): array;

    /**
     * @return array<string,array<int,callable|string>>
     */
    public function events(): array;

    /**
     * @return string|null
     */
    public function form(): ?string;

    /**
     * @return array<string,array<int,array{hook:callable|string,priority:integer}>>
     */
    public function hooks(): array;

    /**
     * @return string[]
     */
    public function indexWith(): array;

    /**
     * @return string[]
     */
    public function indexWithCount(): array;

    /**
     * @return string
     */
    public function model(): string;

    /**
     * @return string|null
     */
    public function morph(): ?string;

    /**
     * @return ModelOperationEnum[]
     */
    public function operations(): array;

    /**
     * @return string|null
     */
    public function replicateAction(): ?string;

    /**
     * @return string|null
     */
    public function request(): ?string;

    /**
     * @return string
     */
    public function route(): string;

    /**
     * @return string|null
     */
    public function table(): ?string;

    #endregion
}
