import { defineConfig } from "vite";
import { resolve } from "node:path";

export default defineConfig({
    publicDir: false,
    build: {
        outDir: "public",
        emptyOutDir: false,
        rollupOptions: {
            input: resolve("resources/js/app.js"),
            output: {
                entryFileNames: "js/app.js",
                assetFileNames: (asset) => asset.name === "app.css"
                    ? "css/app.css"
                    : "assets/[name]-[hash][extname]",
            },
        },
    },
});
