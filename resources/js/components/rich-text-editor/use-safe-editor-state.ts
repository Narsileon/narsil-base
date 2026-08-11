import { Editor, useEditorState } from "@tiptap/react";

type UseSafeEditorStateOptions<T> = {
  editor: Editor;
  fallback: T;
  selector: (editor: Editor) => T;
};

function useSafeEditorState<T>({
  editor,
  fallback,
  selector,
}: UseSafeEditorStateOptions<T>): T {
  return (
    useEditorState({
      editor: editor,
      selector: (context) => {
        if (!context.editor || context.editor.isDestroyed) {
          return fallback;
        }

        return selector(context.editor);
      },
    }) ?? fallback
  );
}

export default useSafeEditorState;
