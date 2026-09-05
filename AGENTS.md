# Narsil Base Agents

## Narsil skills

- Use the Narsil skills repository at `../narsil-skills/skills` as the source of truth for package changes.
- Follow `general` for refactors and single-return methods, `php` and `laravel` for PHP, `blade` for Blade components, `html` for markup, and `tailwind` for utility classes.
- For Blade changes, read and follow the Blade skill together with its PHP, HTML, and Tailwind references before editing.

## Temporary React-to-Blade migration

- This package is temporarily migrating shared components from React to Laravel Blade.
- For components already migrated, Blade is the implementation to update and React is reference material unless the task explicitly requests React changes.
- Preserve equivalent behavior, accessibility, variants, translations, and composition APIs while migrating.
- Remove this entire section from `AGENTS.md` once the React-to-Blade migration is complete.

## Alpine rules

- Use Alpine for local Blade interaction only; keep data preparation, validation, persistence, and computed values in PHP view components.
- Use component-specific state names such as `dropdownOpen`, `popoverOpen`, `selectOpen`, and `tooltipOpen`; do not introduce generic Alpine state such as `open`.
- Bind boolean component props explicitly with real PHP values, for example `:as-child="true"`, rather than relying on bare or string attributes.
- Use `@js(...)` for server values embedded in Alpine expressions and avoid unescaped server values in JavaScript.
- Keep teleported popovers, dropdowns, and tooltips anchored to their original trigger. Use a teleport-safe lookup such as `$root.querySelector('[data-slot=...]')` instead of relying on a local `$refs` collection.
- Do not nest interactive elements. Use the component’s `asChild` composition mode when a trigger or button must wrap another interactive component.
- Use `x-cloak` with `x-show` for initially hidden content and register shared Alpine plugins and stores through `resources/js/alpine.ts`.

## Translation synchronization

- For translations in this package, `lang/en` is the canonical locale.
- Keep `lang/de` and `lang/fr` synchronized with `lang/en` whenever translation files or keys are added, removed, or renamed.
- German and French files must preserve the same nested key structure and interpolation placeholders as English; translate values rather than copying English text.
- Before completing a base-package change, check that all English keys touched by the change exist in both German and French.
- This rule applies to `narsil-base` only for now. Do not apply it to the host app or other Narsil packages unless their agent instructions are updated separately.
