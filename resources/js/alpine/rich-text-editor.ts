import { Editor } from "@tiptap/core";
import Subscript from "@tiptap/extension-subscript";
import Superscript from "@tiptap/extension-superscript";
import TextAlign from "@tiptap/extension-text-align";
import { Placeholder } from "@tiptap/extensions";
import StarterKit from "@tiptap/starter-kit";
import type Alpine from "alpinejs";

type RichTextEditorConfig = {
  id: string;
  placeholder: string;
  readOnly: boolean;
  required: boolean;
  value: string;
};

type RichTextEditorState = {
  $dispatch?: (name: string, detail?: Record<string, unknown>) => void;
  $el?: HTMLElement;
  active: Record<string, boolean>;
  capabilities: Record<string, boolean>;
  value: string;
  can: (command: string) => boolean;
  destroy: () => void;
  init: () => void;
  isActive: (name: string, attributes?: Record<string, unknown>) => boolean;
  refresh: () => void;
  redo: () => void;
  setValue: (value: unknown) => void;
  setTextAlign: (alignment: string) => void;
  toggleBold: () => void;
  toggleBulletList: () => void;
  toggleHeading: (level: number) => void;
  toggleItalic: () => void;
  toggleOrderedList: () => void;
  toggleStrike: () => void;
  toggleSubscript: () => void;
  toggleSuperscript: () => void;
  toggleUnderline: () => void;
  undo: () => void;
};

export default function registerRichTextEditor(alpine: typeof Alpine): void {
  alpine.data("narsilRichTextEditor", (config: RichTextEditorConfig) => {
    let editor: Editor | null = null;

    function stateKey(
      name: string,
      attributes?: Record<string, unknown>,
    ): string {
      return `${name}:${JSON.stringify(attributes ?? {})}`;
    }

    function canCommand(command: string): boolean {
      let can = false;

      if (editor && !editor.isDestroyed && editor.isEditable) {
        const chain = editor.can().chain();

        switch (command) {
          case "undo":
            can = chain.undo().run();
            break;
          case "redo":
            can = chain.redo().run();
            break;
        }
      }

      return can;
    }

    function executeCommand(command: string, argument?: string): void {
      if (editor && !editor.isDestroyed && editor.isEditable) {
        const chain = editor.chain().focus();

        switch (command) {
          case "toggleBold":
            chain.toggleBold().run();
            break;
          case "toggleItalic":
            chain.toggleItalic().run();
            break;
          case "toggleUnderline":
            chain.toggleUnderline().run();
            break;
          case "toggleStrike":
            chain.toggleStrike().run();
            break;
          case "toggleSuperscript":
            chain.unsetSubscript().toggleSuperscript().run();
            break;
          case "toggleSubscript":
            chain.unsetSuperscript().toggleSubscript().run();
            break;
          case "setTextAlign":
            if (argument) {
              chain.setTextAlign(argument).run();
            }
            break;
          case "toggleBulletList":
            chain.toggleBulletList().run();
            break;
          case "toggleOrderedList":
            chain.toggleOrderedList().run();
            break;
          case "undo":
            chain.undo().run();
            break;
          case "redo":
            chain.redo().run();
            break;
        }
      }
    }

    const state: RichTextEditorState = {
      active: {},
      capabilities: {},
      value: config.value,

      can(this: RichTextEditorState, command: string): boolean {
        return this.capabilities[command] ?? false;
      },

      destroy(): void {
        editor?.destroy();
        editor = null;
      },

      init(this: RichTextEditorState): void {
        editor = new Editor({
          element: this.$el?.querySelector<HTMLElement>(
            "[data-rich-text-content]",
          ),
          extensions: [
            Placeholder.configure({
              emptyEditorClass:
                "before:pointer-events-none before:float-left before:h-0 before:text-muted-foreground before:content-[attr(data-placeholder)]",
              placeholder: config.placeholder,
            }),
            StarterKit.configure({
              bulletList: {
                HTMLAttributes: {
                  class: "list-disc list-outside ml-6",
                },
              },
              heading: {
                levels: [1, 2, 3, 4, 5, 6],
              },
              orderedList: {
                HTMLAttributes: {
                  class: "list-decimal list-outside ml-6",
                },
              },
            }),
            Subscript,
            Superscript,
            TextAlign.configure({
              alignments: ["left", "center", "right", "justify"],
              types: ["heading", "paragraph"],
            }),
          ],
          content: this.value,
          editable: !config.readOnly,
          editorProps: {
            attributes: {
              "aria-required": config.required ? "true" : "false",
              class: [
                "prose max-w-none whitespace-normal! text-foreground ring-2 ring-transparent outline-none",
                "rounded-md rounded-t-none bg-accent/50 px-3 py-2",
                "focus-visible:ring-primary",
                "[&[contenteditable=false]]:cursor-not-allowed [&[contenteditable=false]]:opacity-50",
                "[&>h1]:text-4xl",
                "[&>h2]:text-3xl",
                "[&>h3]:text-2xl",
                "[&>h4]:text-xl",
                "[&>h5]:text-lg",
                "[&>h6]:text-base",
              ].join(" "),
              id: config.id,
            },
          },
          onSelectionUpdate: () => this.refresh(),
          onTransaction: () => this.refresh(),
          onUpdate: ({ editor: currentEditor }) => {
            this.value = currentEditor.getHTML();
            this.$dispatch?.("rich-text-change", { value: this.value });
            this.$dispatch?.("input");
            this.refresh();
          },
        });

        this.refresh();
      },

      isActive(
        this: RichTextEditorState,
        name: string,
        attributes?: Record<string, unknown>,
      ): boolean {
        return this.active[stateKey(name, attributes)] ?? false;
      },

      redo(): void {
        executeCommand("redo");
      },

      refresh(this: RichTextEditorState): void {
        if (editor && !editor.isDestroyed) {
          const active: Record<string, boolean> = {};
          const names = [
            "bold",
            "italic",
            "underline",
            "strike",
            "superscript",
            "subscript",
            "bulletList",
            "orderedList",
          ];

          names.forEach((name) => {
            active[stateKey(name)] = editor?.isActive(name) ?? false;
          });

          ["left", "center", "right", "justify"].forEach((textAlign) => {
            const attributes = { textAlign };

            active[stateKey("textAlign", attributes)] =
              editor?.isActive(attributes) ?? false;
          });

          [1, 2, 3, 4, 5, 6].forEach((level) => {
            const attributes = { level };

            active[stateKey("heading", attributes)] =
              editor?.isActive("heading", attributes) ?? false;
          });

          this.active = active;
          this.capabilities = Object.fromEntries(
            ["undo", "redo"].map((command) => [command, canCommand(command)]),
          );
        }
      },

      setTextAlign(alignment: string): void {
        executeCommand("setTextAlign", alignment);
      },

      toggleBold(): void {
        executeCommand("toggleBold");
      },

      toggleBulletList(): void {
        executeCommand("toggleBulletList");
      },

      setValue(this: RichTextEditorState, value: unknown): void {
        const nextValue = typeof value === "string" ? value : "";

        this.value = nextValue;

        if (editor && !editor.isDestroyed && editor.getHTML() !== nextValue) {
          editor.commands.setContent(nextValue, { emitUpdate: false });
        }

        this.refresh();
      },

      toggleHeading(this: RichTextEditorState, level: number): void {
        if (editor && !editor.isDestroyed && editor.isEditable) {
          if (!Number.isInteger(level) || level < 1 || level > 6) {
            return;
          }

          editor
            .chain()
            .focus()
            .toggleHeading({ level: level as 1 | 2 | 3 | 4 | 5 | 6 })
            .run();
        }
      },

      toggleItalic(): void {
        executeCommand("toggleItalic");
      },

      toggleOrderedList(): void {
        executeCommand("toggleOrderedList");
      },

      toggleStrike(): void {
        executeCommand("toggleStrike");
      },

      toggleSubscript(): void {
        executeCommand("toggleSubscript");
      },

      toggleSuperscript(): void {
        executeCommand("toggleSuperscript");
      },

      toggleUnderline(): void {
        executeCommand("toggleUnderline");
      },

      undo(): void {
        executeCommand("undo");
      },
    };

    return state;
  });
}
