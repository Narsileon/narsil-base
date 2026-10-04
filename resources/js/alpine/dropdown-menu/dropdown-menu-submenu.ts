import type Alpine from "alpinejs";

type SubmenuAnchor = {
  contextElement: HTMLElement;
  getBoundingClientRect: () => DOMRect;
};

export default function registerDropdownMenuSubmenu(alpine: typeof Alpine): void {
  alpine.data("narsilDropdownMenuSubmenu", function () {
    let anchor: SubmenuAnchor | null = null;

    return {
      dropdownSubmenuOpen: false,
      getDropdownSubmenuAnchor(positioner: HTMLElement): SubmenuAnchor | null {
        const trigger = this.$root.querySelector<HTMLElement>(
          "[data-slot=dropdown-menu-submenu-trigger]",
        );

        if (!anchor && trigger) {
          anchor = {
            contextElement: trigger,
            getBoundingClientRect(): DOMRect {
              const triggerRect = trigger.getBoundingClientRect();
              const parentPopup = trigger.closest<HTMLElement>(
                "[data-slot=dropdown-menu-popup], [data-slot=dropdown-menu-submenu-popup]",
              );
              const parentRect = parentPopup?.getBoundingClientRect() ?? triggerRect;
              const popup = positioner.querySelector<HTMLElement>(
                "[data-slot=dropdown-menu-submenu-popup]",
              );
              const popupStyle = getComputedStyle(popup ?? positioner);
              const topInset =
                parseFloat(popupStyle.paddingTop) + parseFloat(popupStyle.borderTopWidth);

              return new DOMRect(
                parentRect.left,
                triggerRect.top - topInset,
                parentRect.width,
                triggerRect.height,
              );
            },
          };
        }

        return anchor;
      },
    };
  });
}
