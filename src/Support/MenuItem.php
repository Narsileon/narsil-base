<?php

declare(strict_types=1);

namespace Narsil\Base\Support;

#region USE

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Narsil\Base\Enums\RequestMethodEnum;

#endregion

class MenuItem extends Fluent
{
    #region CONSTRUCTOR

    /**
     * @param string $id
     *
     * @return void
     */
    public function __construct(string $id)
    {
        $this->id($id);
        $this->method(RequestMethodEnum::GET->value);
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param Collection<MenuItem> $collection
     *
     * @return Collection
     */
    final public static function filterByPermissions(Collection $collection): Collection
    {
        $user = Auth::user();

        return $collection
            ->filter(function (MenuItem $item) use ($user)
            {
                $permissions = $item->get('permissions', []);

                if (empty($permissions))
                {
                    return true;
                }

                if (!$user)
                {
                    return false;
                }

                foreach ($permissions as $permission)
                {
                    if ($user->can($permission))
                    {
                        return true;
                    }
                    if (!$user->hasPermission($permission))
                    {
                        return false;
                    }
                }

                return true;
            })
            ->values();
    }

    /**
     * @param string $before
     *
     * @return static
     */
    final public function before(string $before): static
    {
        $this->set('before', $before);

        return $this;
    }

    /**
     * @param string $group
     *
     * @return static
     */
    final public function group(string $group): static
    {
        $this->set('group', $group);

        return $this;
    }

    /**
     * @param string $icon
     *
     * @return static
     */
    final public function icon(string $icon): static
    {
        $this->set('icon', $icon);

        return $this;
    }

    /**
     * @param string $id
     *
     * @return static
     */
    final public function id(string $id): static
    {
        $this->set('id', $id);

        return $this;
    }

    /**
     * @param string $label
     * @param boolean $upperFirst
     *
     * @return static
     */
    final public function label(string $label, bool $upperFirst = true): static
    {
        $this->set('label', $upperFirst ? Str::ucfirst($label) : $label);

        return $this;
    }

    /**
     * @param string $method
     *
     * @return static
     */
    final public function method(string $method): static
    {
        $this->set('method', $method);

        return $this;
    }

    /**
     * @param boolean $modal
     *
     * @return static
     */
    final public function modal(bool $modal): static
    {
        $this->set('modal', $modal);

        return $this;
    }

    /**
     * @param array $parameters
     *
     * @return static
     */
    final public function parameters(array $parameters): static
    {
        $this->set('parameters', $parameters);

        return $this;
    }

    /**
     * @param string[] $permissions
     *
     * @return static
     */
    final public function permissions(array $permissions): static
    {
        $this->set('permissions', $permissions);

        return $this;
    }

    /**
     * @param string $route
     *
     * @return static
     */
    final public function route(string $route): static
    {
        $this->set('route', $route);

        return $this;
    }

    /**
     * @param string $target
     *
     * @return static
     */
    final public function target(string $target): static
    {
        $this->set('target', $target);

        return $this;
    }

    #endregion
}
