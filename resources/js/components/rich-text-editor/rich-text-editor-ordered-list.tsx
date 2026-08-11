import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Icon } from "@narsil-ui/components/icon";
import { Toggle } from "@narsil-ui/components/toggle";
import { useTranslator } from "@narsil-ui/components/translator";
import { Editor } from "@tiptap/react";
import { type ComponentProps } from "react";
import useSafeEditorState from "./use-safe-editor-state";

type RichTextEditorOrderedListProps = ComponentProps<typeof Toggle> & {
  editor: Editor;
};

function RichTextEditorOrderedList({
  editor,
  ...props
}: RichTextEditorOrderedListProps) {
  const { trans } = useTranslator();

  const { isOrderedList } = useSafeEditorState({
    editor: editor,
    fallback: {
      isOrderedList: false,
    },
    selector: (editor) => {
      return {
        isOrderedList: editor.isActive("orderedList"),
      };
    },
  });

  const label = trans("rich-text-editor.ordered_list");

  return (
    <Tooltip tooltip={label}>
      <Toggle
        aria-label={label}
        pressed={isOrderedList}
        size="icon"
        onClick={() => editor.chain().focus().toggleOrderedList().run()}
        {...props}
      >
        <Icon name="list-ordered" />
      </Toggle>
    </Tooltip>
  );
}

export default RichTextEditorOrderedList;
