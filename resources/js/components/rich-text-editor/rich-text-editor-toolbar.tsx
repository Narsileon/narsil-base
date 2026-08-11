import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Button } from "@narsil-ui/components/button";
import {
  DropdownMenuPopup,
  DropdownMenuPortal,
  DropdownMenuPositioner,
  DropdownMenuRoot,
  DropdownMenuTrigger,
} from "@narsil-ui/components/dropdown-menu";
import { Icon } from "@narsil-ui/components/icon";
import {
  RichTextEditorBold,
  RichTextEditorBulletList,
  RichTextEditorHeading,
  RichTextEditorItalic,
  RichTextEditorOrderedList,
  RichTextEditorRedo,
  RichTextEditorStrike,
  RichTextEditorSubscript,
  RichTextEditorSuperscript,
  RichTextEditorTextAlign,
  RichTextEditorUnderline,
  RichTextEditorUndo,
} from "@narsil-ui/components/rich-text-editor";
import { Separator } from "@narsil-ui/components/separator";
import { useTranslator } from "@narsil-ui/components/translator";
import { cn } from "@narsil-ui/lib/utils";
import { useCurrentEditor } from "@tiptap/react";
import { ComponentProps } from "react";

type RichTextEditorToolbarProps = ComponentProps<"div"> & {
  modules: string[];
};

const headings = [1, 2, 3, 4, 5, 6] as const;

function RichTextEditorToolbar({
  className,
  modules = [],
  ...props
}: RichTextEditorToolbarProps) {
  const { editor } = useCurrentEditor();
  const { trans } = useTranslator();

  if (!editor || editor.isDestroyed || !editor.isEditable) {
    return null;
  }

  function hasModule(key: string) {
    if (modules?.length === 0) {
      return true;
    }

    return modules?.includes(key);
  }

  function hasModules(keys: string[]) {
    if (modules?.length === 0) {
      return true;
    }

    return keys?.some((key) => modules?.includes(key));
  }

  const headingsLabel = trans("ui.headings");

  return (
    <div
      className={cn(
        "border-color border-color no-scrollbar flex h-11 items-center gap-1 overflow-x-auto border-b px-1",
        className,
      )}
      {...props}
    >
      {/* Basic styles */}
      {hasModule("bold") && <RichTextEditorBold editor={editor} />}
      {hasModule("italic") && <RichTextEditorItalic editor={editor} />}
      {hasModule("underline") && <RichTextEditorUnderline editor={editor} />}
      {hasModule("strike") && <RichTextEditorStrike editor={editor} />}

      {/* Advanced styles */}
      {hasModules(["superscript", "subscript"]) && (
        <>
          <Separator orientation="vertical" />

          {hasModule("superscript") && (
            <RichTextEditorSuperscript editor={editor} />
          )}
          {hasModule("subscript") && (
            <RichTextEditorSubscript editor={editor} />
          )}
        </>
      )}

      {/* Headings */}
      {hasModules(headings.map((level) => `heading_${level}`)) && (
        <>
          <Separator orientation="vertical" />
          <DropdownMenuRoot>
            <DropdownMenuTrigger
              render={
                <Tooltip tooltip={headingsLabel}>
                  <Button
                    aria-label={headingsLabel}
                    size="icon"
                    variant="ghost"
                  >
                    <Icon name="heading" />
                  </Button>
                </Tooltip>
              }
            />
            <DropdownMenuPortal>
              <DropdownMenuPositioner>
                <DropdownMenuPopup className="min-w-9">
                  {headings
                    .filter((level) => hasModule(`heading_${level}`) !== false)
                    .map((level) => {
                      return (
                        <RichTextEditorHeading
                          editor={editor}
                          level={level}
                          key={level}
                        />
                      );
                    })}
                </DropdownMenuPopup>
              </DropdownMenuPositioner>
            </DropdownMenuPortal>
          </DropdownMenuRoot>
        </>
      )}

      {/* Alignment */}
      {hasModules([
        "align_left",
        "align_center",
        "align_right",
        "align_justify",
      ]) && (
        <>
          <Separator orientation="vertical" />

          {hasModule("align_left") && (
            <RichTextEditorTextAlign alignment="left" editor={editor} />
          )}
          {hasModule("align_center") && (
            <RichTextEditorTextAlign alignment="center" editor={editor} />
          )}
          {hasModule("align_right") && (
            <RichTextEditorTextAlign alignment="right" editor={editor} />
          )}
          {hasModule("align_justify") && (
            <RichTextEditorTextAlign alignment="justify" editor={editor} />
          )}
        </>
      )}

      {/* Lists */}
      {hasModules(["bullet_list", "ordered_list"]) && (
        <>
          <Separator orientation="vertical" />

          {hasModule("bullet_list") && (
            <RichTextEditorBulletList editor={editor} />
          )}
          {hasModule("ordered_list") && (
            <RichTextEditorOrderedList editor={editor} />
          )}
        </>
      )}

      {/* Controls */}
      {hasModules(["undo", "redo"]) && (
        <>
          <Separator orientation="vertical" />

          {hasModule("undo") && <RichTextEditorUndo editor={editor} />}
          {hasModule("redo") && <RichTextEditorRedo editor={editor} />}
        </>
      )}
    </div>
  );
}

export default RichTextEditorToolbar;
