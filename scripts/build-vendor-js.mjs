#!/usr/bin/env node
/**
 * Gera public/js/vendor.js concatenando os plugins legados de
 * resources/plugins/ na ordem correta (jQuery/moment antes de qualquer coisa
 * que dependa deles).
 *
 * Por que concatenação crua em vez de um entry point do Vite: esses arquivos
 * foram escritos para rodar como <script> soltos no navegador (sloppy mode,
 * escopo global compartilhado) -- é assim que jQuery, AdminLTE e os plugins
 * conseguem se anexar em `window`/`window.jQuery`/`$.fn`. Passando pelo
 * Rolldown/Rollup como módulo ES, três coisas quebram ao mesmo tempo:
 *   1. Tree-shaking remove declarações de topo sem uso aparente dentro do
 *      próprio bundle (ex.: `class Kanban {}` sem `window.Kanban = ...`
 *      explícito), mesmo quando o app real usa esse global via outra página.
 *   2. Qualquer arquivo com `typeof module === "object"` no cabeçalho UMD é
 *      auto-detectado como CommonJS e envolvido numa função "lazy" que só
 *      roda se algo chamar `require(...)` -- nunca acontece aqui, e o
 *      arquivo inteiro (jQuery incluído) simplesmente nunca executa.
 *   3. Padrões UMD que passam `this` para descobrir o objeto global
 *      (`})(this)`) recebem `undefined` no topo de um módulo ES (sempre
 *      strict mode), em vez de `window` como em um <script> comum.
 * Concatenação de texto crua não analisa nada disso -- é exatamente o
 * mesmo modelo de execução que separar cada arquivo em um <script> próprio,
 * só que num único arquivo por performance (uma requisição em vez de ~40).
 */
import { readFileSync, writeFileSync, mkdirSync, cpSync } from "node:fs";
import { dirname, resolve } from "node:path";
import { fileURLToPath } from "node:url";

const __dirname = dirname(fileURLToPath(import.meta.url));
const root = resolve(__dirname, "..");
const pluginsDir = resolve(root, "resources/plugins");
const outFile = resolve(root, "public/js/vendor.js");

// TinyMCE não sabe se auto-detectar dentro do bundle concatenado (ver nota
// sobre tinymce.min.js abaixo) -- copia crua dos assets que ele carrega em
// runtime via HTTP (skins/themes/plugins/icons), sem passar pelo Rollup/Vite.
for (const dir of ["skins", "themes", "plugins", "icons"]) {
    cpSync(resolve(pluginsDir, "tinymce", dir), resolve(root, "public/js/tinymce", dir), { recursive: true });
}

const files = [
    // Núcleo: jQuery/jQuery UI/Bootstrap/moment precisam vir primeiro.
    "AdminLTE/plugins/jQuery/jquery-3.7.1.min.js",
    "AdminLTE/plugins/jQueryUI/jquery-ui.min.js",
    "bootstrap/js/bootstrap.js",
    "AdminLTE/plugins/daterangepicker/moment.min.js",
    "moment-timezone-with-data.min.js",

    // Core AdminLTE
    "AdminLTE/js/adminlte.js",

    // Plugins que acompanham o template AdminLTE
    "AdminLTE/plugins/select2/select2.full.min.js",
    "AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js",
    "AdminLTE/plugins/daterangepicker/daterangepicker.js",
    "AdminLTE/plugins/datepicker/bootstrap-datepicker.min.js",
    "AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js",
    "AdminLTE/plugins/input-mask/jquery.inputmask.js",
    "AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js",
    "AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js",
    "AdminLTE/plugins/input-mask/jquery.inputmask.numeric.extensions.js",
    "AdminLTE/plugins/input-mask/jquery.inputmask.phone.extensions.js",
    "AdminLTE/plugins/input-mask/jquery.inputmask.regex.extensions.js",
    "AdminLTE/plugins/seiyria-bootstrap-slider/bootstrap-slider.min.js",
    "AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",
    "AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js",
    "AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js",
    "AdminLTE/plugins/jvectormap/jquery-jvectormap-usa-en.js",
    "AdminLTE/plugins/pace/pace.min.js",
    "AdminLTE/plugins/DataTables/datatables.js",
    "icheck/icheck.min.js",
    "onscan/onscan.min.js",

    // Plugins fora do diretório AdminLTE
    "bootstrap-colorpicker/bootstrap-colorpicker.min.js",
    "bootstrap-datetimepicker/bootstrap-datetimepicker.min.js",
    "bootstrap-fileinput/fileinput.min.js",
    "bootstrap-tour/bootstrap-tour.min.js",
    "calculator/calculator.js",
    "dropzone/dropzone.js",
    "jKanban/jKanbanBoard.js",
    "jquery-validation-1.16.0/dist/jquery.validate.min.js",
    "jquery-validation-1.16.0/dist/additional-methods.min.js",
    "jquery.steps/jquery.steps.min.js",
    "jquery.top_scrollbar.js",
    "mousetrap/mousetrap.min.js",
    "mousetrap/mousetrap-record.min.js",
    "patternlock/patternlock.min.js",
    "printThis.js",
    "sweetalert/sweetalert.min.js",
    "toastr/toastr.min.js",
    "accounting.min.js",
    "decimal.min.js",
    "fullcalendar/fullcalendar.min.js",
    // window.tinyMCEPreInit (setado em javascripts.blade.php, antes deste
    // bundle carregar) substitui a autodetecção de base path que TinyMCE faria
    // olhando a src de um <script src="tinymce*.js"> -- não existe aqui dentro
    // de um bundle concatenado.
    "tinymce/tinymce.min.js",
];

const banner = `/* public/js/vendor.js -- gerado por scripts/build-vendor-js.mjs, não editar direto. */\n`;
const body = files
    .map((relPath) => {
        const content = readFileSync(resolve(pluginsDir, relPath), "utf8");
        return `/* ---- resources/plugins/${relPath} ---- */\n${content}\n`;
    })
    .join(";\n");

mkdirSync(dirname(outFile), { recursive: true });
writeFileSync(outFile, banner + body);
console.log(`vendor.js gerado (${files.length} arquivos, ${(Buffer.byteLength(banner + body) / 1024 / 1024).toFixed(2)} MB)`);
