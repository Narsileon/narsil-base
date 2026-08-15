<?php

namespace Narsil\Base\Http\Data\TanStackTables;

#region USE

use Illuminate\Support\Fluent;
use Narsil\Base\Models\Users\TanStackTable;

#endregion

/**
 * @property string $uuid.
 * @property string $name.
 */
class DataTablePreset extends Fluent
{
    #region CONSTRUCTOR

    /**
     * @param string $uuid
     * @param string $name
     *
     * @return void
     */
    public function __construct(
        string $uuid,
        string $name,
    )
    {
        $this->set(TanStackTable::NAME, $name);
        $this->set(TanStackTable::UUID, $uuid);
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param TanStackTable $tanStacktable
     *
     * @return DataTablePreset
     */
    public static function fromModel(TanStackTable $tanStacktable): DataTablePreset
    {
        return new DataTablePreset(
            name: $tanStacktable?->{TanStackTable::NAME},
            uuid: $tanStacktable?->{TanStackTable::UUID},
        );
    }

    #endregion
}
