import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Icon } from "@narsil-ui/components/icon";
import { Toggle } from "@narsil-ui/components/toggle";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorUnderlineProps = ComponentProps<typeof Toggle> & {
  editor: Editor;
};

function RichTextEditorUnderline({
  editor,
  ...props
}: RichTextEditorUnderlineProps) {
  const { trans } = useTranslator();

  const { canUnderline, isUnderline } = useSafeEditorState({
    editor: editor,
    fallback: {
      canUnderline: false,
      isUnderline: false,
    },
    selector: (editor) => {
      return {
        canUnderline: editor.can().chain().focus().toggleUnderline().run(),
        isUnderline: editor.isActive("underline"),
      };
    },
  });

  const label = trans("rich-text-editor.underline");

  return (
    <Tooltip tooltip={label}>
      <Toggle
        aria-label={label}
        disabled={!canUnderline}
        pressed={isUnderline}
        size="icon"
        onClick={() => editor.chain().focus().toggleUnderline().run()}
        {...props}
      >
        <Icon name="underline" />
      </Toggle>
    </Tooltip>
  );
}

export default RichTextEditorUnderline;
