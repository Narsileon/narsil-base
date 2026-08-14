<?php

declare(strict_types=1);

namespace Narsil\Base;

#region USE

use Narsil\Base\Enums\ModelHookEventEnum;

#endregion

final class Narsil
{
    #region PROPERTIES

    /**
     * @var array<string,string>
     */
    private array $actions = [];

    /**
     * @var array<string,string>
     */
    private array $forms = [];

    /**
     * @var array<string,string>
     */
    private array $menus = [];

    /**
     * @var array<string,string>
     */
    private array $morphs = [];

    /**
     * @var array<string,string>
     */
    private array $requests = [];

    /**
     * @var array<string,string>
     */
    private array $resources = [];

    /**
     * @var array<string,string>
     */
    private array $tables = [];

    /**
     * @var array<string,string>
     */
    private array $fields = [];

    /**
     * @var array<string,string>
     */
    private array $inputs = [];

    /**
     * @var array<string,string>
     */
    private array $modelDefinitions = [];

    /**
     * @var array<string,array<string,array<int,array{hook:callable|string,priority:integer}>>>
     */
    private array $modelHooks = [];

    /**
     * @var string[]
     */
    private array $locales = [];

    /**
     * @var string[]
     */
    private array $plugins = [];

    /**
     * @var string[]
     */
    private array $relations = [];

    /**
     * @var string[]
     */
    private array $schemas = [];

    #endregion

    #region PUBLIC METHODS

    /**
     * @param string $abstract
     * @param string $concrete
     *
     * @return self
     */
    public function action(string $abstract, string $concrete): self
    {
        $this->actions[$abstract] = $concrete;

        return $this;
    }

    /**
     * @return array<string,string>
     */
    public function actions(): array
    {
        return $this->actions;
    }

    /**
     * @param string $type
     * @param string $concrete
     *
     * @return self
     */
    public function field(string $type, string $concrete): self
    {
        $this->fields[$type] = $concrete;

        return $this;
    }

    /**
     * @return array<string,string>
     */
    public function fields(): array
    {
        return $this->fields;
    }

    /**
     * @param string $abstract
     * @param string $concrete
     *
     * @return self
     */
    public function form(string $abstract, string $concrete): self
    {
        $this->forms[$abstract] = $concrete;

        return $this;
    }

    /**
     * @return array<string,string>
     */
    public function forms(): array
    {
        return $this->forms;
    }

    /**
     * @param string $type
     * @param string $concrete
     *
     * @return self
     */
    public function input(string $type, string $concrete): self
    {
        $this->inputs[$type] = $concrete;

        return $this;
    }

    /**
     * @return array<string,string>
     */
    public function inputs(): array
    {
        return $this->inputs;
    }

    /**
     * @param string[] $locales
     *
     * @return self
     */
    public function locales(array $locales): self
    {
        $this->locales = $locales;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getLocales(): array
    {
        return $this->locales;
    }

    /**
     * @return string[]
     */
    public function getPlugins(): array
    {
        return $this->plugins;
    }

    /**
     * @param string $abstract
     * @param string $concrete
     *
     * @return self
     */
    public function menu(string $abstract, string $concrete): self
    {
        $this->menus[$abstract] = $concrete;

        return $this;
    }

    /**
     * @param string $model
     * @param string $definition
     *
     * @return self
     */
    public function modelDefinition(string $model, string $definition): self
    {
        $this->modelDefinitions[$model] = $definition;

        return $this;
    }

    /**
     * @return array<string,string>
     */
    public function modelDefinitions(): array
    {
        return $this->modelDefinitions;
    }

    /**
     * @param string $model
     * @param ModelHookEventEnum $event
     * @param callable|string $hook
     * @param integer $priority
     *
     * @return self
     */
    public function modelHook(string $model, ModelHookEventEnum $event, callable|string $hook, int $priority = 0): self
    {
        $this->modelHooks[$model][$event->value][] = [
            'hook' => $hook,
            'priority' => $priority,
        ];

        usort($this->modelHooks[$model][$event->value], function (array $first, array $second): int
        {
            return $second['priority'] <=> $first['priority'];
        });

        return $this;
    }

    /**
     * @return array<string,array<string,array<int,array{hook:callable|string,priority:integer}>>>
     */
    public function modelHooks(): array
    {
        return $this->modelHooks;
    }

    /**
     * @return array<string,string>
     */
    public function menus(): array
    {
        return $this->menus;
    }

    /**
     * @param string $model
     * @param string $table
     *
     * @return self
     */
    public function morph(string $model, string $table): self
    {
        $this->morphs[$model] = $table;

        return $this;
    }

    /**
     * @return array<string,string>
     */
    public function morphs(): array
    {
        return $this->morphs;
    }

    /**
     * @param string[] $plugins
     *
     * @return self
     */
    public function plugins(array $plugins): self
    {
        $this->plugins = $plugins;

        return $this;
    }

    /**
     * @param string $field
     *
     * @return self
     */
    public function relation(string $field): self
    {
        $this->relations[] = $field;

        return $this;
    }

    /**
     * @return string[]
     */
    public function relations(): array
    {
        return $this->relations;
    }

    /**
     * @param string $abstract
     * @param string $concrete
     *
     * @return self
     */
    public function request(string $abstract, string $concrete): self
    {
        $this->requests[$abstract] = $concrete;

        return $this;
    }

    /**
     * @return array<string,string>
     */
    public function requests(): array
    {
        return $this->requests;
    }

    /**
     * @param string $abstract
     * @param string $concrete
     *
     * @return self
     */
    public function resource(string $abstract, string $concrete): self
    {
        $this->resources[$abstract] = $concrete;

        return $this;
    }

    /**
     * @return array<string,string>
     */
    public function resources(): array
    {
        return $this->resources;
    }

    /**
     * @param string[] $schemas
     *
     * @return self
     */
    public function schemas(array $schemas): self
    {
        $this->schemas = $schemas;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getSchemas(): array
    {
        return $this->schemas;
    }

    /**
     * @param string $table
     * @param string $concrete
     *
     * @return self
     */
    public function table(string $table, string $concrete): self
    {
        $this->tables[$table] = $concrete;

        return $this;
    }

    /**
     * @return array<string,string>
     */
    public function tables(): array
    {
        return $this->tables;
    }

    #endregion
}
