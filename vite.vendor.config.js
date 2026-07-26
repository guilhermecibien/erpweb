import { defineConfig } from "vite";
import { resolve } from "node:path";

// Build só do CSS legado (vendor.css: Bootstrap 3/AdminLTE 2 + plugins,
// vendorizados como código-fonte em resources/plugins/). O JS equivalente
// (public/js/vendor.js) é gerado à parte por scripts/build-vendor-js.mjs via
// concatenação crua, não por este build -- ver comentário no topo daquele
// arquivo sobre por que passar esses scripts legados pelo Rollup/Rolldown
// como módulo ES quebra jQuery/AdminLTE/plugins. CSS não tem esse problema
// (é processamento de texto/@import, não execução), então continua no Vite.
export default defineConfig({
    publicDir: false,
    build: {
        outDir: "public",
        emptyOutDir: false,
        rollupOptions: {
            input: resolve("resources/css/vendor.css"),
            output: {
                assetFileNames: (asset) => asset.name === "vendor.css"
                    ? "css/vendor.css"
                    : "assets/[name]-[hash][extname]",
            },
        },
    },
});
