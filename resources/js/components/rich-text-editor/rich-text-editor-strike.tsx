import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Icon } from "@narsil-ui/components/icon";
import { Toggle } from "@narsil-ui/components/toggle";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorStrikeProps = ComponentProps<typeof Toggle> & {
  editor: Editor;
};

function RichTextEditorStrike({ editor, ...props }: RichTextEditorStrikeProps) {
  const { trans } = useTranslator();

  const { canStrike, isStrike } = useSafeEditorState({
    editor: editor,
    fallback: {
      canStrike: false,
      isStrike: false,
    },
    selector: (editor) => {
      return {
        canStrike: editor.can().chain().focus().toggleStrike().run(),
        isStrike: editor.isActive("strike"),
      };
    },
  });

  const label = trans("rich-text-editor.strike");

  return (
    <Tooltip tooltip={label}>
      <Toggle
        aria-label={label}
        disabled={!canStrike}
        pressed={isStrike}
        size="icon"
        onClick={() => editor.chain().focus().toggleStrike().run()}
        {...props}
      >
        <Icon name="strikethrough" />
      </Toggle>
    </Tooltip>
  );
}

export default RichTextEditorStrike;
