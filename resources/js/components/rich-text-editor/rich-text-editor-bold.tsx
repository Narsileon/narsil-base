import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Icon } from "@narsil-ui/components/icon";
import { Toggle } from "@narsil-ui/components/toggle";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorBoldProps = ComponentProps<typeof Toggle> & {
  editor: Editor;
};

function RichTextEditorBold({ editor, ...props }: RichTextEditorBoldProps) {
  const { trans } = useTranslator();

  const { canBold, isBold } = useSafeEditorState({
    editor: editor,
    fallback: {
      canBold: false,
      isBold: false,
    },
    selector: (editor) => {
      return {
        canBold: editor.can().chain().focus().toggleBold().run(),
        isBold: editor.isActive("bold"),
      };
    },
  });

  const label = trans("rich-text-editor.bold");

  return (
    <Tooltip tooltip={label}>
      <Toggle
        aria-label={label}
        disabled={!canBold}
        pressed={isBold}
        size="icon"
        onClick={() => editor.chain().focus().toggleBold().run()}
        {...props}
      >
        <Icon name="bold" />
      </Toggle>
    </Tooltip>
  );
}

export default RichTextEditorBold;
