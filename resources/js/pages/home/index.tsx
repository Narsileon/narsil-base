import { Link } from "@inertiajs/react";
import { CardContent, CardRoot } from "@narsil-ui/components/card";
import { Heading } from "@narsil-ui/components/heading";
import { Icon } from "@narsil-ui/components/icon";
import { useMinLg, useMinMd, useMinSm, useMinXl } from "@narsil-ui/hooks/use-breakpoints";
import { cn } from "@narsil-ui/lib/utils";
import type { MenuItem } from "@narsil-ui/types";
import { route } from "ziggy-js";

type HomeProps = {
  items: MenuItem[];
};

function Home({ items }: HomeProps) {
  const homeItems = items.filter((item) => item.route !== "narsil.home");

  const isSm = useMinSm();
  const isMd = useMinMd();
  const isLg = useMinLg();
  const isXl = useMinXl();

  let columns = isXl ? 5 : isLg ? 4 : isMd ? 3 : isSm ? 2 : 1;

  columns = Math.min(columns, Math.max(homeItems.length, 1));

  return (
    <div className="flex min-h-full w-full items-center justify-center">
      <div
        className={cn(
          "grid gap-6 p-6",
          columns === 2 && "grid-cols-2",
          columns === 3 && "grid-cols-3",
          columns === 4 && "grid-cols-4",
          columns === 5 && "grid-cols-5",
        )}
      >
        {homeItems.map((item) => (
          <CardRoot className="aspect-square h-48 w-48 cursor-pointer shadow-lg" key={item.route}>
            <CardContent className="h-full w-full p-0 transition-all hover:bg-accent hover:text-accent-foreground">
              <Link
                className="flex h-full w-full flex-col items-center justify-center gap-3 text-center"
                href={route(item.route, item.parameters)}
              >
                {item.icon ? <Icon name={item.icon} /> : null}
                <Heading level="h2" variant="h5">
                  {item.label}
                </Heading>
              </Link>
            </CardContent>
          </CardRoot>
        ))}
      </div>
    </div>
  );
}

export default Home;
