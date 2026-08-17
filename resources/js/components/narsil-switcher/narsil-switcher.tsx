import { Link, usePage } from "@inertiajs/react";
import { Button } from "@narsil-ui/components/button";
import {
  DropdownMenuItem,
  DropdownMenuPopup,
  DropdownMenuPortal,
  DropdownMenuPositioner,
  DropdownMenuRoot,
  DropdownMenuTrigger,
} from "@narsil-ui/components/dropdown-menu";
import { Icon } from "@narsil-ui/components/icon";
import type { MenuItem } from "@narsil-ui/types";
import { route } from "ziggy-js";

type NarsilNavigationProps = {
  navigation?: {
    home: MenuItem[];
  };
};

type NarsilSwitcherProps = {
  collapsed?: boolean;
};

function NarsilSwitcher({ collapsed = false }: NarsilSwitcherProps) {
  const { props } = usePage<NarsilNavigationProps>();

  const items = props.navigation?.home ?? [];

  const currentItem = items.find((item) => route().current(item.route));
  const currentLabel = currentItem?.label ?? items[0]?.label ?? "Home";

  return (
    <DropdownMenuRoot>
      <DropdownMenuTrigger
        render={
          <Button
            aria-label={currentLabel}
            className="w-full justify-start truncate"
            size={collapsed ? "icon" : "default"}
            variant="sidebar"
          >
            <Icon name="narsil" />
            {!collapsed ? currentLabel : null}
          </Button>
        }
      />
      <DropdownMenuPortal>
        <DropdownMenuPositioner align="start">
          <DropdownMenuPopup>
            {items.map((item) => (
              <DropdownMenuItem
                key={item.route}
                render={
                  <Link href={route(item.route, item.parameters)} method={item.method}>
                    <Icon name="narsil" />
                    {item.label}
                  </Link>
                }
              />
            ))}
          </DropdownMenuPopup>
        </DropdownMenuPositioner>
      </DropdownMenuPortal>
    </DropdownMenuRoot>
  );
}

export default NarsilSwitcher;
