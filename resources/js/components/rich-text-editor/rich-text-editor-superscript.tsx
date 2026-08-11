import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Icon } from "@narsil-ui/components/icon";
import { Toggle } from "@narsil-ui/components/toggle";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorSuperscriptProps = ComponentProps<typeof Toggle> & {
  editor: Editor;
};

function RichTextEditorSuperscript({
  editor,
  ...props
}: RichTextEditorSuperscriptProps) {
  const { trans } = useTranslator();

  const { canSuperscript, isSuperscript } = useSafeEditorState({
    editor: editor,
    fallback: {
      canSuperscript: false,
      isSuperscript: false,
    },
    selector: (editor) => {
      return {
        canSuperscript: editor.can().chain().focus().toggleSuperscript().run(),
        isSuperscript: editor.isActive("superscript"),
      };
    },
  });

  const label = trans("rich-text-editor.superscript");

  return (
    <Tooltip tooltip={label}>
      <Toggle
        aria-label={label}
        disabled={!canSuperscript}
        pressed={isSuperscript}
        size="icon"
        onClick={() => {
          editor.chain().focus().unsetSubscript().run();
          editor.chain().focus().toggleSuperscript().run();
        }}
        {...props}
      >
        <Icon name="superscript" />
      </Toggle>
    </Tooltip>
  );
}

export default RichTextEditorSuperscript;
