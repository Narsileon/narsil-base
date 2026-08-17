import { Link, usePage } from "@inertiajs/react";
import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Button } from "@narsil-ui/components/button";
import { Icon } from "@narsil-ui/components/icon";
import { NarsilSwitcher } from "@narsil-ui/components/narsil-switcher";
import {
  SidebarContent,
  SidebarFooter,
  SidebarGroup,
  SidebarGroupContent,
  SidebarGroupLabel,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuItem,
  SidebarRail,
  SidebarRoot,
  useSidebar,
} from "@narsil-ui/components/sidebar";
import { useTranslator } from "@narsil-ui/components/translator";
import { cn } from "@narsil-ui/lib/utils";
import type { MenuItem } from "@narsil-ui/types";
import { groupBy } from "lodash-es";
import { type ComponentProps } from "react";
import { route } from "ziggy-js";

type SidebarNavigationProps = {
  navigation?: {
    sidebars?: Record<string, MenuItem[]>;
  };
};

type SidebarProps = ComponentProps<typeof SidebarRoot> & {
  name?: string;
};

function Sidebar({ name = "cms", ...props }: SidebarProps) {
  const { props: pageProps } = usePage<SidebarNavigationProps>();
  const { open, setOpenMobile, toggleSidebar } = useSidebar();
  const { trans } = useTranslator();

  const sidebar = pageProps.navigation?.sidebars?.[name] ?? [];

  const groupedMenu = groupBy(sidebar, (item) => {
    return item.group ?? `_${item.label}`;
  });

  return (
    <SidebarRoot collapsible="icon" {...props}>
      <SidebarHeader className="h-13 border-b">
        <NarsilSwitcher collapsed={!open} />
      </SidebarHeader>
      <SidebarContent>
        <SidebarMenu>
          {Object.entries(groupedMenu)?.map(([group, items], groupIndex) => {
            return group.startsWith("_") ? (
              <SidebarMenuItem key={groupIndex}>
                <Tooltip hidden={open} tooltip={items[0].label}>
                  <Button
                    aria-label={items[0].label}
                    data-active={route(items[0].route, items[0].parameters).endsWith(
                      window.location.pathname,
                    )}
                    nativeButton={false}
                    variant="sidebar"
                    render={
                      <Link
                        href={route(items[0].route, items[0].parameters)}
                        onSuccess={() => setOpenMobile(false)}
                      >
                        {items[0].icon ? <Icon name={items[0].icon} /> : null}
                        {items[0].label}
                      </Link>
                    }
                  />
                </Tooltip>
              </SidebarMenuItem>
            ) : (
              <SidebarGroup key={groupIndex}>
                <SidebarGroupLabel>{group}</SidebarGroupLabel>
                <SidebarGroupContent>
                  {items.map((item, itemIndex) => {
                    return (
                      <SidebarMenuItem key={itemIndex}>
                        <Tooltip hidden={open} tooltip={item.label}>
                          <Button
                            aria-label={item.label}
                            data-active={route(item.route, item.parameters).endsWith(
                              window.location.pathname,
                            )}
                            nativeButton={false}
                            variant="sidebar"
                            render={
                              item.target === "_blank" ? (
                                <a href={route(item.route, item.parameters)} target="_blank">
                                  {item.icon ? <Icon name={item.icon} /> : null}
                                  {item.label}
                                </a>
                              ) : (
                                <Link
                                  href={route(item.route, item.parameters)}
                                  onSuccess={() => setOpenMobile(false)}
                                >
                                  {item.icon ? <Icon name={item.icon} /> : null}
                                  {item.label}
                                </Link>
                              )
                            }
                          />
                        </Tooltip>
                      </SidebarMenuItem>
                    );
                  })}
                </SidebarGroupContent>
              </SidebarGroup>
            );
          })}
        </SidebarMenu>
      </SidebarContent>
      <SidebarFooter className="h-13 border-t">
        <Tooltip hidden={open} tooltip={trans("accessibility.toggle_sidebar")}>
          <Button onClick={toggleSidebar} variant="sidebar">
            <Icon className={cn("duration-300", open && "rotate-180")} name="chevron-left" />
            {open && trans("accessibility.close_sidebar")}
          </Button>
        </Tooltip>
      </SidebarFooter>
      <SidebarRail />
    </SidebarRoot>
  );
}

export default Sidebar;
