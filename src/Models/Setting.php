<?php

declare(strict_types=1);

namespace Narsil\Base\Models;

#region USE

use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Policies\SettingPolicy;

#endregion

#[UsePolicy(SettingPolicy::class)]
class Setting extends Model
{
    #region CONSTRUCTOR

    /**
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->table = self::TABLE;
        $this->primaryKey = self::HANDLE;
        $this->keyType = 'string';
        $this->incrementing = false;
        $this->timestamps = false;
        $this->guarded = [];

        parent::__construct($attributes);
    }

    #endregion

    #region CONSTANTS

    /**
     * The table associated with the model.
     *
     * @var string
     */
    final public const TABLE = 'public.settings';

    #region • COLUMNS

    /**
     * The name of the backend language setting.
     *
     * @var string
     */
    final public const BACKEND_LANGUAGE = 'backend_language';

    /**
     * The name of the default color setting.
     *
     * @var string
     */
    final public const DEFAULT_COLOR = 'default_color';

    /**
     * The name of the default radius setting.
     *
     * @var string
     */
    final public const DEFAULT_RADIUS = 'default_radius';

    /**
     * The name of the settings handle column.
     *
     * @var string
     */
    final public const HANDLE = 'handle';

    /**
     * The name of the setting value column.
     *
     * @var string
     */
    final public const VALUE = 'value';

    #endregion

    #endregion

    #region PUBLIC METHODS

    /**
     * @param string $handle
     * @param mixed $default
     *
     * @return mixed
     */
    final public static function getValue(string $handle, mixed $default = null): mixed
    {
        return static::query()
            ->where(self::HANDLE, $handle)
            ->value(self::VALUE) ?? $default;
    }

    /**
     * @return array<string,string>
     */
    final public static function getValues(): array
    {
        return static::query()
            ->pluck(self::VALUE, self::HANDLE)
            ->all();
    }

    /**
     * @param string $handle
     * @param string $value
     *
     * @return self
     */
    final public static function setValue(string $handle, string $value): self
    {
        return static::query()->updateOrCreate(
            [self::HANDLE => $handle],
            [self::VALUE => $value],
        );
    }

    #endregion
}
