import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Icon } from "@narsil-ui/components/icon";
import { Toggle } from "@narsil-ui/components/toggle";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorBulletListProps = ComponentProps<typeof Toggle> & {
  editor: Editor;
};

function RichTextEditorBulletList({
  editor,
  ...props
}: RichTextEditorBulletListProps) {
  const { trans } = useTranslator();

  const { isBulletList } = useSafeEditorState({
    editor: editor,
    fallback: {
      isBulletList: false,
    },
    selector: (editor) => {
      return {
        isBulletList: editor.isActive("bulletList"),
      };
    },
  });

  const label = trans("rich-text-editor.bullet_list");

  return (
    <Tooltip tooltip={label}>
      <Toggle
        aria-label={label}
        pressed={isBulletList}
        size="icon"
        onClick={() => editor.chain().focus().toggleBulletList().run()}
        {...props}
      >
        <Icon name="list-bullet" />
      </Toggle>
    </Tooltip>
  );
}

export default RichTextEditorBulletList;
