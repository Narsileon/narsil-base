import type Alpine from "alpinejs";

type RelationEditorWire = {
  cancelEditor(): Promise<void>;
  saveEditor(encoded: string): Promise<void>;
};

function getWire(context: unknown): RelationEditorWire {
  return (context as { $wire: RelationEditorWire }).$wire;
}

export default function registerRelationEditor(alpine: typeof Alpine): void {
  alpine.data("narsilRelationEditor", function () {
    return {
      busy: false,
      dialogOpen: true,
      async close() {
        if (!this.busy) {
          await getWire(this).cancelEditor();
        }
      },
      async save(form: HTMLFormElement) {
        if (this.busy) {
          return;
        }

        this.busy = true;
        const data = new URLSearchParams();

        new FormData(form).forEach(function (value, name) {
          if (typeof value === "string") {
            data.append(name, value);
          }
        });

        try {
          await getWire(this).saveEditor(data.toString());
        } finally {
          this.busy = false;
        }
      },
    };
  });
}
