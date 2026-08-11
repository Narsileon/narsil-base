import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Icon } from "@narsil-ui/components/icon";
import { Toggle } from "@narsil-ui/components/toggle";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorSubscriptProps = ComponentProps<typeof Toggle> & {
  editor: Editor;
};

function RichTextEditorSubscript({
  editor,
  ...props
}: RichTextEditorSubscriptProps) {
  const { trans } = useTranslator();

  const { canSubscript, isSubscript } = useSafeEditorState({
    editor: editor,
    fallback: {
      canSubscript: false,
      isSubscript: false,
    },
    selector: (editor) => {
      return {
        canSubscript: editor.can().chain().focus().toggleSubscript().run(),
        isSubscript: editor.isActive("subscript"),
      };
    },
  });

  const label = trans("rich-text-editor.subscript");

  return (
    <Tooltip tooltip={label}>
      <Toggle
        aria-label={label}
        disabled={!canSubscript}
        pressed={isSubscript}
        size="icon"
        onClick={() => {
          editor.chain().focus().unsetSuperscript().run();
          editor.chain().focus().toggleSubscript().run();
        }}
        {...props}
      >
        <Icon name="subscript" />
      </Toggle>
    </Tooltip>
  );
}

export default RichTextEditorSubscript;
