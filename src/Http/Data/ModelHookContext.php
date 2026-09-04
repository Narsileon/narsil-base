<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Data;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

#endregion

final class ModelHookContext
{
    #region CONSTRUCTOR

    /**
     * @param Request $request
     * @param array<string,mixed> $attributes
     * @param Model|null $model
     * @param mixed $result
     *
     * @return void
     */
    public function __construct(Request $request, array $attributes = [], ?Model $model = null, mixed $result = null)
    {
        $this->attributes = $attributes;
        $this->model = $model;
        $this->request = $request;
        $this->result = $result;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public array $attributes;

    /**
     * @var Model|null
     */
    public ?Model $model;

    /**
     * @var mixed
     */
    public mixed $result;

    /**
     * @var Request
     */
    public readonly Request $request;

    #endregion
}
