import type Alpine from "alpinejs";

type Theme = "light" | "dark" | "system";
type PersistTheme = (theme: Theme) => Promise<unknown>;

export default function registerTheme(alpine: typeof Alpine): void {
  alpine.data("narsilTheme", function (initialTheme: Theme, persistTheme: PersistTheme) {
    const systemTheme = window.matchMedia("(prefers-color-scheme: dark)");
    const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
    let systemThemeListener: (() => void) | null = null;
    let activeTransition: ViewTransition | null = null;

    return {
      theme: initialTheme,
      themeTransitioning: false,
      init(): void {
        this.applyTheme(this.theme);
        systemThemeListener = () => {
          if (this.theme === "system") {
            this.applyTheme(this.theme);
          }
        };
        systemTheme.addEventListener("change", systemThemeListener);
      },
      destroy(): void {
        if (systemThemeListener) {
          systemTheme.removeEventListener("change", systemThemeListener);
        }

        activeTransition?.skipTransition();
      },
      applyTheme(theme: Theme): void {
        const resolvedTheme = this.resolveTheme(theme);
        const root = document.documentElement;

        root.dataset.theme = theme;
        root.classList.toggle("dark", resolvedTheme === "dark");
        root.classList.toggle("light", resolvedTheme === "light");
      },
      resolveTheme(theme: Theme): "light" | "dark" {
        let resolvedTheme: "light" | "dark" = "light";

        if (theme === "dark" || (theme === "system" && systemTheme.matches)) {
          resolvedTheme = "dark";
        }

        return resolvedTheme;
      },
      async selectTheme(theme: Theme, trigger: HTMLElement): Promise<void> {
        if (theme !== this.theme) {
          this.theme = theme;
          await this.transitionTheme(theme, trigger);

          if (this.theme === theme) {
            await persistTheme(theme);
          }
        }
      },
      async transitionTheme(theme: Theme, trigger: HTMLElement): Promise<void> {
        activeTransition?.skipTransition();
        activeTransition = null;
        this.themeTransitioning = false;

        const changesAppearance =
          document.documentElement.classList.contains("dark") !==
          (this.resolveTheme(theme) === "dark");

        if (document.startViewTransition && !reducedMotion.matches && changesAppearance) {
          const rect = trigger.getBoundingClientRect();
          const x = rect.left + rect.width / 2;
          const y = rect.top + rect.height / 2;
          const radius = Math.hypot(
            Math.max(x, window.innerWidth - x),
            Math.max(y, window.innerHeight - y),
          );
          this.themeTransitioning = true;

          const transition = document.startViewTransition(() => this.applyTheme(this.theme));

          activeTransition = transition;

          try {
            await transition.ready;

            if (activeTransition === transition) {
              const animation = document.documentElement.animate(
                {
                  clipPath: [
                    `circle(0px at ${x}px ${y}px)`,
                    `circle(${radius}px at ${x}px ${y}px)`,
                  ],
                },
                {
                  duration: 800,
                  easing: "ease-in-out",
                  pseudoElement: "::view-transition-new(root)",
                },
              );

              await animation.finished;
              await transition.finished;
            }
          } catch {
            if (activeTransition === transition) {
              this.applyTheme(this.theme);
            }
          } finally {
            if (activeTransition === transition) {
              activeTransition = null;
              this.themeTransitioning = false;
            }
          }
        } else {
          this.applyTheme(theme);
        }
      },
    };
  });
}
