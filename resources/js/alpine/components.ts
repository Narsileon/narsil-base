import type Alpine from "alpinejs";

type ComponentModule = {
  default: (alpine: typeof Alpine) => void;
};

const components = new Map<string, () => Promise<ComponentModule>>([
  [
    "narsilResourceModal",
    function () {
      return import("./form/resource-modal");
    },
  ],
  [
    "narsilRelationEditor",
    function () {
      return import("./sortable/sortable-relations");
    },
  ],
  [
    "narsilSortableRelations",
    function () {
      return import("./sortable/sortable-relations");
    },
  ],
  [
    "narsilForm",
    function () {
      return import("./form/form");
    },
  ],
  [
    "narsilSortableList",
    function () {
      return import("./sortable/sortable-list");
    },
  ],
  [
    "narsilSortableTree",
    function () {
      return import("./sortable/sortable-tree");
    },
  ],
]);

export default function registerAlpineComponents(alpine: typeof Alpine): void {
  const loaded = new Set<string>();
  const pending = new Map<string, Promise<void>>();

  alpine.interceptInit(
    alpine.skipDuringClone((element, skip): void => {
      const expression = element.getAttribute("x-data") ?? "";
      const name = expression.trim().match(/^([\w$]+)\s*\(/)?.[1] ?? "";
      const load = components.get(name);

      if (load && !loaded.has(name) && !element._x_ignore) {
        element._x_ignore = true;
        skip();

        let registration = pending.get(name);

        if (!registration) {
          registration = load().then((module): void => {
            module.default(alpine);
            loaded.add(name);
          });

          pending.set(name, registration);
        }

        registration
          .then((): void => {
            delete element._x_ignore;

            if (element.isConnected) {
              alpine.initTree(element);
            }
          })
          .catch((error: unknown): void => {
            pending.delete(name);
            console.error(`Unable to load Alpine component ${name}.`, error);
          });
      }
    }),
  );
}
