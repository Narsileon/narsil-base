<?php

declare(strict_types=1);

namespace Narsil\Base\Livewire;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Services\ModelDefinitionService;

#endregion

final class InputRelations extends Component
{
    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    #[Locked]
    public array $configuration = [];

    /**
     * @var array<string,mixed>|null
     */
    #[Locked]
    public ?array $editor = null;

    /**
     * @var string
     */
    #[Locked]
    public string $inputId = '';

    /**
     * @var array<int,array<string,mixed>>
     */
    #[Locked]
    public array $items = [];

    /**
     * @var array<int,array<string,mixed>>
     */
    #[Locked]
    public array $languages = [];

    #endregion

    #region PUBLIC METHODS

        /**
     * @param string $path
     * @param int $groupIndex
     * @param string $value
     *
     * @return void
     */
    public function addOption(string $path, int $groupIndex, string $value): void
    {
        $configuration = $this->configurationAt($path);
        $group = data_get($configuration, 'options.' . $groupIndex);
        $option = collect(data_get($group, 'options', []))->firstWhere('value', $value);
        abort_unless($group && $option, 422);
        $items = $this->itemsAt($path);
        $identifier = data_get($option, 'identifier');
        abort_if(data_get($configuration, 'unique') && collect($items)->contains('identifier', $identifier), 422);
        $valueKey = $group['optionValue'];
        $handle = $option['value'];
        $suffix = 1;

        while (collect($items)->contains($valueKey, $handle))
        {
            $handle = $option['value'] . '_' . $suffix++;
        }

        $items[] = [
            'uuid' => (string) Str::uuid(),
            'icon' => data_get($option, 'icon'),
            'id' => data_get($option, 'id'),
            'identifier' => $identifier,
            $group['optionLabel'] => $option['label'],
            $valueKey => $handle,
            'width' => 100,
        ];
        $this->putItems($path, $items);
    }

    /**
     * @return void
     */
    public function cancelEditor(): void
    {
        $this->editor = null;
        $this->resetErrorBag();
    }

    /**
     * @param string $path
     * @param string|null $uuid
     *
     * @return void
     */
    public function edit(string $path, ?string $uuid = null): void
    {
        $configuration = $this->configurationAt($path);
        abort_unless(data_get($configuration, 'form'), 422);
        abort_if($uuid === null && !data_get($configuration, 'intermediate'), 422);
        $item = [];

        if ($uuid !== null)
        {
            $item = collect($this->itemsAt($path))->firstWhere('uuid', $uuid);
            abort_unless($item, 422);
        }

        $this->resetErrorBag();
        $this->editor = ['key' => (string) Str::uuid(), 'path' => $path, 'uuid' => $uuid, 'item' => $item];
    }

    /**
     * @param mixed $input
     * @param string $inputId
     * @param mixed $languages
     * @param mixed $value
     *
     * @return void
     */
    public function mount(mixed $input, string $inputId, mixed $languages = [], mixed $value = []): void
    {
        $this->configuration = $this->normalize($input);
        $this->inputId = $inputId;
        $this->items = $this->normalizeItems($this->normalize($value), $this->configuration);
        $this->languages = $this->normalize($languages);
    }

    /**
     * @param string $path
     * @param int $groupIndex
     * @param string|int $id
     *
     * @return void
     */
    public function refreshOptions(string $path, int $groupIndex, string|int $id): void
    {
        $configuration = $this->configurationAt($path);
        $group = data_get($configuration, 'options.' . $groupIndex);
        $route = data_get($group, 'routes.create');
        abort_unless($route, 422);
        $definition = app(ModelDefinitionService::class)->resolveRoute(Str::beforeLast($route, '.'));
        $modelClass = $definition->model();
        $model = $modelClass::query()->findOrFail($id);
        Gate::authorize(AbilityEnum::VIEW, $model);
        $data = $model->toArray();

        if (method_exists($model, 'toArrayWithTranslations'))
        {
            $data = $model->toArrayWithTranslations();
        }

        $option = [
            'icon' => data_get($data, 'icon'),
            'id' => $model->getKey(),
            'identifier' => data_get($data, 'identifier'),
            'label' => data_get($data, $group['optionLabel']),
            'value' => data_get($data, $group['optionValue']),
        ];
        $prefix = '';

        if ($path !== '')
        {
            foreach (array_chunk(explode('.', $path), 2) as $segment)
            {
                $prefix .= 'intermediate.relation.input.';
            }
        }

        $key = $prefix . 'options.' . $groupIndex . '.options';
        $options = collect(data_get($this->configuration, $key, []))->keyBy('identifier');
        $options[$option['identifier']] = $option;
        data_set($this->configuration, $key, $options->values()->all());
    }

    /**
     * @param string $path
     * @param string $uuid
     *
     * @return void
     */
    public function remove(string $path, string $uuid): void
    {
        $this->configurationAt($path);
        $items = collect($this->itemsAt($path))->reject(function (array $item) use ($uuid): bool
        {
            return $item['uuid'] === $uuid;
        })->values()->all();
        $this->putItems($path, $items);
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $editorForm = null;
        $editorLanguages = $this->languages;

        if ($this->editor !== null)
        {
            $configuration = $this->configurationAt($this->editor['path']);
            $editorForm = json_decode(json_encode($configuration['form'], JSON_THROW_ON_ERROR), false, 512, JSON_THROW_ON_ERROR);
            $editorLanguages = data_get($configuration, 'form.languages', $editorLanguages);
        }

        return view('narsil::livewire.input-relations.root', [
            'editorForm' => $editorForm,
            'editorLanguages' => $editorLanguages,
            'fields' => $this->hiddenFields($this->items, $this->inputName($this->inputId)),
            'list' => $this->listView('', $this->configuration),
        ]);
    }

    /**
     * @param string $path
     * @param array<int,string> $order
     *
     * @return void
     */
    public function reorder(string $path, array $order): void
    {
        $this->configurationAt($path);
        $items = collect($this->itemsAt($path))->keyBy('uuid');
        abort_unless(count($order) === $items->count() && count(array_unique($order)) === count($order), 422);
        abort_unless(collect($order)->every(function (string $uuid) use ($items): bool
        {
            return $items->has($uuid);
        }), 422);
        $this->putItems($path, array_map(function (string $uuid) use ($items): array
        {
            return $items[$uuid];
        }, $order));
    }

    /**
     * @param string $encoded
     *
     * @return void
     */
    public function saveEditor(string $encoded): void
    {
        abort_unless($this->editor !== null, 422);
        parse_str($encoded, $submitted);
        $path = $this->editor['path'];
        $configuration = $this->configurationAt($path);
        $item = $this->editor['item'];
        $rules = [];

        foreach ($this->formFields(data_get($configuration, 'form.steps', [])) as $field)
        {
            $id = $field['id'];
            $value = data_get($submitted, $id, data_get($field, 'input.defaultValue'));

            if (in_array(data_get($field, 'input.type'), ['array', 'table', 'relations'], true) && !$value)
            {
                $value = [];
            }

            data_set($item, $id, $value);

            if (data_get($field, 'required'))
            {
                $ruleKey = $id;

                if (data_get($field, 'translatable'))
                {
                    $ruleKey .= '.' . data_get($configuration, 'form.defaultLanguage', app()->getLocale());
                }

                $rules[$ruleKey] = ['required'];
            }
        }

        $this->editor['item'] = $item;
        Validator::make($item, $rules)->validate();

        $group = $this->itemGroup($configuration, $item);
        $valueKey = data_get($group, 'optionValue', 'handle');
        $identifier = data_get($item, $valueKey);
        $items = $this->itemsAt($path);
        $duplicate = collect($items)->contains(function (array $other) use ($identifier, $valueKey): bool
        {
            return $other['uuid'] !== $this->editor['uuid'] && (string) data_get($other, $valueKey) === (string) $identifier;
        });

        if ($duplicate || !is_scalar($identifier) || (string) $identifier === '')
        {
            $this->editor['item'] = $item;
            throw ValidationException::withMessages([
                $valueKey => trans('validation.unique', ['attribute' => $valueKey]),
            ]);
        }

        $item['uuid'] = $this->editor['uuid'] ?? (string) Str::uuid();

        if ($this->editor['uuid'] === null)
        {
            $items[] = $item;
        }
        else
        {
            foreach ($items as $index => $other)
            {
                if ($other['uuid'] === $this->editor['uuid'])
                {
                    $items[$index] = $item;
                }
            }
        }

        $this->putItems($path, $items);
        $this->cancelEditor();
    }

    /**
     * @param string $path
     * @param string $uuid
     * @param int $width
     *
     * @return void
     */
    public function setWidth(string $path, string $uuid, int $width): void
    {
        $this->configurationAt($path);
        abort_unless(in_array($width, [25, 33, 50, 67, 75, 100], true), 422);
        $items = $this->itemsAt($path);

        foreach ($items as &$item)
        {
            if ($item['uuid'] === $uuid)
            {
                $item['width'] = $width;
            }
        }

        $this->putItems($path, $items);
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $uuid
     * @param int $position
     *
     * @return void
     */
    public function transfer(string $from, string $to, string $uuid, int $position): void
    {
        $sourceConfiguration = $this->configurationAt($from);
        $targetConfiguration = $this->configurationAt($to);
        abort_unless($from !== $to && $sourceConfiguration === $targetConfiguration, 422);
        abort_if(data_get($targetConfiguration, 'intermediate'), 422);
        $source = $this->itemsAt($from);
        $target = $this->itemsAt($to);
        $item = collect($source)->firstWhere('uuid', $uuid);
        abort_unless($item && $position >= 0 && $position <= count($target), 422);
        $valueKey = data_get($this->itemGroup($targetConfiguration, $item), 'optionValue', 'handle');
        abort_if(collect($target)->contains($valueKey, data_get($item, $valueKey)), 422);
        abort_if(data_get($targetConfiguration, 'unique') && collect($target)->contains('identifier', data_get($item, 'identifier')), 422);
        $source = array_values(array_filter($source, function (array $other) use ($uuid): bool
        {
            return $other['uuid'] !== $uuid;
        }));
        array_splice($target, $position, 0, [$item]);
        $this->putItems($from, $source);
        $this->putItems($to, $target);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param string $path
     *
     * @return array<string,mixed>
     */
    private function configurationAt(string $path): array
    {
        $configuration = $this->configuration;
        $items = $this->items;

        if ($path !== '')
        {
            $segments = explode('.', $path);
            abort_unless(count($segments) % 2 === 0, 422);

            foreach (array_chunk($segments, 2) as [$index, $relation])
            {
                abort_unless(ctype_digit($index) && isset($items[(int) $index]), 422);
                abort_unless($relation === data_get($configuration, 'intermediate.relation.id'), 422);
                $items = data_get($items, $index . '.' . $relation, []) ?? [];
                $configuration = data_get($configuration, 'intermediate.relation.input', []);
            }
        }

        return $configuration;
    }

    /**
     * @param array<int,array<string,mixed>> $elements
     *
     * @return array<int,array<string,mixed>>
     */
    private function formFields(array $elements): array
    {
        $fields = [];

        foreach ($elements as $element)
        {
            if (isset($element['input']))
            {
                $fields[] = $element;
            }
            else
            {
                $fields = array_merge($fields, $this->formFields($element['elements'] ?? []));
            }
        }

        return $fields;
    }

    /**
     * @param array<mixed> $values
     * @param string $prefix
     *
     * @return array<int,array{name:string,value:string}>
     */
    private function hiddenFields(array $values, string $prefix): array
    {
        $fields = [];

        foreach ($values as $key => $value)
        {
            $name = $prefix . '[' . $key . ']';

            if (is_array($value))
            {
                $fields = array_merge($fields, $this->hiddenFields($value, $name));
            }
            else
            {
                if (is_bool($value))
                {
                    $value = (int) $value;
                }

                $fields[] = ['name' => $name, 'value' => (string) $value];
            }
        }

        return $fields;
    }

    /**
     * @param string $id
     *
     * @return string
     */
    private function inputName(string $id): string
    {
        $parts = explode('.', $id);
        $name = array_shift($parts);

        foreach ($parts as $part)
        {
            $name .= '[' . $part . ']';
        }

        return $name;
    }

    /**
     * @param array<string,mixed> $configuration
     * @param array<string,mixed> $item
     *
     * @return array<string,mixed>
     */
    private function itemGroup(array $configuration, array $item): array
    {
        $group = data_get($configuration, 'intermediate');

        if (!$group)
        {
            $group = collect(data_get($configuration, 'options', []))->first(function (array $option) use ($item): bool
            {
                return Str::startsWith((string) data_get($item, 'identifier'), $option['identifier'] . '-');
            }) ?? [];
        }

        return $group;
    }

    /**
     * @param string $path
     *
     * @return array<int,array<string,mixed>>
     */
    private function itemsAt(string $path): array
    {
        $items = $this->items;

        if ($path !== '')
        {
            $items = data_get($items, $path, []) ?? [];
        }

        return $items;
    }

    /**
     * @param string $path
     * @param array<string,mixed> $configuration
     *
     * @return array<string,mixed>
     */
    private function listView(string $path, array $configuration): array
    {
        $items = $this->itemsAt($path);
        $rows = [];
        $relation = data_get($configuration, 'intermediate.relation');

        foreach ($items as $index => $item)
        {
            $group = $this->itemGroup($configuration, $item);
            $label = data_get($item, data_get($group, 'optionLabel', 'label'), '');

            if (is_array($label))
            {
                $label = $label[app()->getLocale()] ?? Arr::first($label);
            }

            $row = [
                'uuid' => $item['uuid'],
                'label' => $label,
                'value' => data_get($item, data_get($group, 'optionValue', 'handle'), ''),
                'icon' => data_get($item, 'icon'),
                'width' => data_get($item, 'width', 100),
                'children' => null,
            ];

            if ($relation)
            {
                $childPath = ltrim($path . '.' . $index . '.' . $relation['id'], '.');
                $row['children'] = $this->listView($childPath, $relation['input']);
            }

            $rows[] = $row;
        }

        $groups = data_get($configuration, 'options', []);

        foreach ($groups as &$group)
        {
            $group['createUrl'] = null;

            if (data_get($group, 'routes.create'))
            {
                $group['createUrl'] = route($group['routes']['create'], data_get($group, 'routes.parameters', []));
            }

            if (data_get($configuration, 'unique'))
            {
                $group['options'] = array_values(array_filter($group['options'], function (array $option) use ($items): bool
                {
                    return !collect($items)->contains('identifier', data_get($option, 'identifier'));
                }));
            }
        }

        return [
            'columns' => data_get($configuration, 'columns', 2),
            'editable' => (bool) data_get($configuration, 'form'),
            'grid' => $relation !== null,
            'groups' => $groups,
            'path' => $path,
            'rows' => $rows,
            'showValue' => !data_get($configuration, 'unique', false),
        ];
    }

    /**
     * @param mixed $value
     *
     * @return array<mixed>
     */
    private function normalize(mixed $value): array
    {
        return json_decode(json_encode($value, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR) ?? [];
    }

    /**
     * @param array<int,array<string,mixed>> $items
     * @param array<string,mixed> $configuration
     *
     * @return array<int,array<string,mixed>>
     */
    private function normalizeItems(array $items, array $configuration): array
    {
        foreach ($items as &$item)
        {
            unset($item['base'], $item['pivot']);
            $item['uuid'] ??= (string) Str::uuid();
            $relation = data_get($configuration, 'intermediate.relation');

            if ($relation)
            {
                $item[$relation['id']] = $this->normalizeItems($item[$relation['id']] ?? [], $relation['input']);
            }
        }

        return array_values($items);
    }

    /**
     * @param string $path
     * @param array<int,array<string,mixed>> $items
     *
     * @return void
     */
    private function putItems(string $path, array $items): void
    {
        foreach ($items as $index => &$item)
        {
            $item['position'] = $index;
        }

        if ($path === '')
        {
            $this->items = $items;
        }
        else
        {
            data_set($this->items, $path, $items);
        }
    }

    #endregion
}
