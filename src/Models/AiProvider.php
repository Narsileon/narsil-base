<?php

declare(strict_types=1);

namespace Narsil\Base\Models;

#region USE

use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Policies\AiProviderPolicy;
use Narsil\Base\Traits\HasDatetimes;

#endregion

#[UsePolicy(AiProviderPolicy::class)]
class AiProvider extends Model
{
    use HasDatetimes;

    #region CONSTRUCTOR

    /**
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->table = self::TABLE;
        $this->guarded = [
            self::ID,
        ];
        $this->hidden = [
            self::API_KEY,
        ];

        $this->mergeCasts([
            self::API_KEY => 'encrypted',
            self::IS_DEFAULT => 'boolean',
        ]);

        parent::__construct($attributes);
    }

    #endregion

    #region CONSTANTS

    /**
     * The table associated with the model.
     *
     * @var string
     */
    final public const TABLE = 'public.ai_providers';

    #region • COLUMNS

    /**
     * The name of the "API key" column.
     *
     * @var string
     */
    final public const API_KEY = 'api_key';

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    final public const CREATED_AT = 'created_at';

    /**
     * The name of the "id" column.
     *
     * @var string
     */
    final public const ID = 'id';

    /**
     * Whether this is the default AI provider.
     *
     * @var string
     */
    final public const IS_DEFAULT = 'is_default';

    /**
     * The name of the "model" column.
     *
     * @var string
     */
    final public const MODEL = 'model';

    /**
     * The name of the "provider" column.
     *
     * @var string
     */
    final public const PROVIDER = 'provider';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    final public const UPDATED_AT = 'updated_at';

    #endregion

    #region • PROVIDERS

    /**
     * Gemini provider identifier.
     *
     * @var string
     */
    final public const PROVIDER_GEMINI = 'gemini';

    #endregion

    #endregion
}
