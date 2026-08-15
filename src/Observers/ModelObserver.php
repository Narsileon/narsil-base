<?php

declare(strict_types=1);

namespace Narsil\Base\Observers;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#endregion

class ModelObserver
{
    #region PUBLIC METHODS

    /**
     * @param Model $model
     *
     * @return void
     */
    public function saved(Model $model): void
    {
        $this->flush($model);
    }

    /**
     * @param Model $model
     *
     * @return void
     */
    public function deleted(Model $model): void
    {
        $this->flush($model);
    }

    /**
     * @param Model $model
     *
     * @return void
     */
    public function restored(Model $model): void
    {
        $this->flush($model);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @param Model $model
     *
     * @return void
     */
    protected function flush(Model $model): void
    {
        Cache::tags($model->getTable())->flush();
    }

    #endregion
}
