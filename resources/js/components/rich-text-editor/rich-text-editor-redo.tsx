import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Button } from "@narsil-ui/components/button";
import { Icon } from "@narsil-ui/components/icon";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorRedoProps = ComponentProps<typeof Button> & {
  editor: Editor;
};

function RichTextEditorRedo({ editor, ...props }: RichTextEditorRedoProps) {
  const { trans } = useTranslator();

  const { canRedo } = useSafeEditorState({
    editor: editor,
    fallback: {
      canRedo: false,
    },
    selector: (editor) => {
      return {
        canRedo: editor.can().chain().focus().redo().run(),
      };
    },
  });

  const label = trans("rich-text-editor.redo");

  return (
    <Tooltip tooltip={label}>
      <Button
        aria-label={label}
        disabled={!canRedo}
        size="icon"
        variant="ghost"
        onClick={() => editor.chain().focus().redo().run()}
        {...props}
      >
        <Icon name="redo" />
      </Button>
    </Tooltip>
  );
}

export default RichTextEditorRedo;
