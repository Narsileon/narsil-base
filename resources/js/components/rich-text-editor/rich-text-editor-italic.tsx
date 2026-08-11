import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Icon } from "@narsil-ui/components/icon";
import { Toggle } from "@narsil-ui/components/toggle";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorItalicProps = ComponentProps<typeof Toggle> & {
  editor: Editor;
  label?: string;
};

function RichTextEditorItalic({ editor, ...props }: RichTextEditorItalicProps) {
  const { trans } = useTranslator();

  const { canItalic, isItalic } = useSafeEditorState({
    editor: editor,
    fallback: {
      canItalic: false,
      isItalic: false,
    },
    selector: (editor) => {
      return {
        canItalic: editor.can().chain().focus().toggleItalic().run(),
        isItalic: editor.isActive("italic"),
      };
    },
  });

  const label = trans("rich-text-editor.italic");

  return (
    <Tooltip tooltip={label}>
      <Toggle
        aria-label={label}
        disabled={!canItalic}
        pressed={isItalic}
        size="icon"
        onClick={() => editor.chain().focus().toggleItalic().run()}
        {...props}
      >
        <Icon name="italic" />
      </Toggle>
    </Tooltip>
  );
}

export default RichTextEditorItalic;
