import { cn } from "@narsil-ui/lib/utils";
import Subscript from "@tiptap/extension-subscript";
import Superscript from "@tiptap/extension-superscript";
import TextAlign from "@tiptap/extension-text-align";
import { Placeholder } from "@tiptap/extensions";
import { EditorContext, EditorOptions, useEditor } from "@tiptap/react";
import StarterKit from "@tiptap/starter-kit";
import { type ReactNode, useEffect, useMemo } from "react";

type RichTextEditorRootProps = Partial<EditorOptions> & {
  children?: ReactNode;
  className?: string;
  placeholder?: string;
  value: string;
  onChange?: (value: string) => void;
};

function RichTextEditorProvider({
  children,
  className,
  placeholder,
  value,
  onChange,
  ...props
}: RichTextEditorRootProps) {
  const extensions = [
    Placeholder.configure({
      emptyEditorClass:
        "before:pointer-events-none before:float-left before:h-0 before:text-muted-foreground before:content-[attr(data-placeholder)]",
      placeholder: placeholder,
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
  ];

  const editor = useEditor({
    extensions: extensions,
    content: value,
    editorProps: {
      attributes: {
        class: cn(
          "prose max-w-none whitespace-normal! text-foreground ring-2 ring-transparent outline-none",
          "rounded-md rounded-t-none bg-accent/50 px-3 py-2",
          "focus-visible:ring-primary",
          "disabled:cursor-not-allowed disabled:opacity-50",
          "[&>h1]:text-4xl",
          "[&>h2]:text-3xl",
          "[&>h3]:text-2xl",
          "[&>h4]:text-xl",
          "[&>h5]:text-lg",
          "[&>h6]:text-base",
          className,
        ),
      },
    },
    onUpdate: ({ editor }) => {
      onChange?.(editor.getHTML());
    },
    ...props,
  });

  useEffect(() => {
    // useEditor destroys and recreates the instance across effect cycles, so a
    // destroyed editor can still be captured here with a null schema.
    if (!editor || editor.isDestroyed) {
      return;
    }

    if (editor.getHTML() !== value) {
      editor.commands.setContent(value);
    }
  }, [editor, value]);

  const providerValue = useMemo(() => {
    return { editor };
  }, [editor]);

  return (
    <EditorContext.Provider value={providerValue}>
      {children}
    </EditorContext.Provider>
  );
}

export default RichTextEditorProvider;
