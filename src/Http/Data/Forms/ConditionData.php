<?php

namespace Narsil\Base\Http\Data\Forms;

#region USE

use Illuminate\Support\Fluent;

#endregion

class ConditionData extends Fluent
{
    #region CONSTRUCTOR

    /**
     * @param string $handle
     * @param string $operator
     * @param string $value
     *
     * @return void
     */
    public function __construct(
        string $handle,
        string $operator,
        string $value,
    )
    {
        $this->set('handle', $handle);
        $this->set('operator', $operator);
        $this->set('value', $value);
    }

    #endregion
}
