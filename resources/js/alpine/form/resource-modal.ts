import type Alpine from "alpinejs";

export default function registerResourceModal(alpine: typeof Alpine): void {
  alpine.data("narsilResourceModal", function () {
    let controller: AbortController | null = null;

    return {
      busy: false,
      dialogOpen: false,
      error: "",
      html: "",
      close() {
        if (!this.busy) {
          controller?.abort();
          this.dialogOpen = false;
          this.html = "";
        }
      },
      destroy() {
        controller?.abort();
      },
      async open() {
        controller?.abort();
        controller = new AbortController();
        this.dialogOpen = true;
        this.error = "";

        try {
          const response = await fetch(this.$root.dataset.resourceUrl ?? "", {
            headers: { "X-Narsil-Modal": "true", Accept: "text/html" },
            signal: controller.signal,
          });

          if (!response.ok) {
            throw new Error(`${response.status} ${response.statusText}`);
          }

          this.html = await response.text();
        } catch (error) {
          if (!controller.signal.aborted) {
            this.error = String(error);
          }
        }
      },
      async submit(event: SubmitEvent) {
        if (this.busy || !(event.target instanceof HTMLFormElement)) {
          return;
        }

        this.busy = true;
        this.error = "";
        const form = event.target;

        try {
          const response = await fetch(form.action, {
            body: new FormData(form),
            headers: { "X-Narsil-Modal": "true", Accept: "application/json" },
            method: "POST",
          });
          const result = await response.json();

          if (!response.ok) {
            this.error = Object.values(result.errors ?? {}).flat().join(" ") || result.message || response.statusText;
          } else {
            this.$dispatch("resource-created", { id: result.id });
            this.dialogOpen = false;
            this.html = "";
          }
        } catch (error) {
          this.error = String(error);
        } finally {
          this.busy = false;
        }
      },
    };
  });
}
