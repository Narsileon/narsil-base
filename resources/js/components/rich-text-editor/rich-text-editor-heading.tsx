import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Icon } from "@narsil-ui/components/icon";
import { Toggle } from "@narsil-ui/components/toggle";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorHeadingProps = ComponentProps<typeof Toggle> & {
  editor: Editor;
  level: 1 | 2 | 3 | 4 | 5 | 6;
};

function RichTextEditorHeading({
  editor,
  level,
  ...props
}: RichTextEditorHeadingProps) {
  const { trans } = useTranslator();

  const { isHeading } = useSafeEditorState({
    editor: editor,
    fallback: {
      isHeading: false,
    },
    selector: (editor) => {
      return {
        isHeading: editor.isActive("heading", { level: level }),
      };
    },
  });

  const label = trans(`rich-text-editor.heading_${level}`);

  return (
    <Tooltip tooltip={label}>
      <Toggle
        aria-label={label}
        pressed={isHeading}
        size="icon"
        onClick={() =>
          editor.chain().focus().toggleHeading({ level: level }).run()
        }
        {...props}
      >
        <Icon className="stroke-foreground" name={`heading-${level}`} />
      </Toggle>
    </Tooltip>
  );
}

export default RichTextEditorHeading;
