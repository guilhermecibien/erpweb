import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import { resolve } from "node:path";

// Build isolado do bundle Vue do dashboard (public/js/dashboard.js), separado
// do vite.config.js principal pelo mesmo motivo do vite.vendor.config.js:
// rodar múltiplos entry points numa única invocação do Rollup/Rolldown faz
// ele extrair um chunk de runtime compartilhado referenciado via `import`
// ESM, o que quebra o carregamento como <script> simples (sem type="module")
// usado em toda a app. Build separado = cada bundle final fica autocontido.
export default defineConfig({
    publicDir: false,
    plugins: [vue()],
    build: {
        outDir: "public",
        emptyOutDir: false,
        rollupOptions: {
            input: resolve("resources/js/dashboard/main.js"),
            output: {
                // iife (não "es"): o bundle é carregado como <script> clássico
                // (sem type="module"), então em formato ES os `var` de topo do
                // bundle (nomes minificados como `$`) vazariam para `window` e
                // colidiriam com globals legados -- veio a acontecer com o `$`
                // do axios sobrescrevendo o `$` do jQuery. iife isola tudo num
                // closure, sem vazar nada para o escopo global.
                format: "iife",
                entryFileNames: "js/dashboard.js",
                assetFileNames: (asset) => asset.name === "main.css"
                    ? "css/dashboard.css"
                    : "assets/[name]-[hash][extname]",
            },
        },
    },
});
