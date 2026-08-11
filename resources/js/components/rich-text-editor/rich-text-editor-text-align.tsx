import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Icon } from "@narsil-ui/components/icon";
import { Toggle } from "@narsil-ui/components/toggle";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorTextAlignProps = ComponentProps<typeof Toggle> & {
  alignment: "left" | "center" | "right" | "justify";
  editor: Editor;
  label?: string;
};

function RichTextEditorTextAlign({
  alignment,
  editor,
  label,
  ...props
}: RichTextEditorTextAlignProps) {
  const { trans } = useTranslator();

  const { isAligned } = useSafeEditorState({
    editor: editor,
    fallback: {
      isAligned: false,
    },
    selector: (editor) => {
      return {
        isAligned: editor.isActive({ textAlign: alignment }),
      };
    },
  });

  if (!label) {
    switch (alignment) {
      case "left":
        label = trans("rich-text-editor.align_left");
        break;
      case "center":
        label = trans("rich-text-editor.align_center");
        break;
      case "right":
        label = trans("rich-text-editor.align_right");
        break;
      case "justify":
        label = trans("rich-text-editor.justify");
        break;
    }
  }

  return (
    <Tooltip tooltip={label}>
      <Toggle
        aria-label={label}
        pressed={isAligned}
        size="icon"
        onClick={() => editor.chain().focus().setTextAlign(alignment).run()}
        {...props}
      >
        <Icon name={`align-${alignment}`} />
      </Toggle>
    </Tooltip>
  );
}

export default RichTextEditorTextAlign;
