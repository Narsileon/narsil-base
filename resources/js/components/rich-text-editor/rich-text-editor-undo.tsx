import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Button } from "@narsil-ui/components/button";
import { Icon } from "@narsil-ui/components/icon";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorUndoProps = ComponentProps<typeof Button> & {
  editor: Editor;
};

function RichTextEditorUndo({ editor, ...props }: RichTextEditorUndoProps) {
  const { trans } = useTranslator();

  const { canUndo } = useSafeEditorState({
    editor: editor,
    fallback: {
      canUndo: false,
    },
    selector: (editor) => {
      return {
        canUndo: editor.can().chain().focus().undo().run(),
      };
    },
  });

  const label = trans("rich-text-editor.undo");

  return (
    <Tooltip tooltip={label}>
      <Button
        aria-label={label}
        disabled={!canUndo}
        size="icon"
        variant="ghost"
        onClick={() => editor.chain().focus().undo().run()}
        {...props}
      >
        <Icon name="undo" />
      </Button>
    </Tooltip>
  );
}

export default RichTextEditorUndo;
