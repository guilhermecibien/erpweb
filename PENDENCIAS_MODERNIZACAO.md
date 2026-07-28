# Pendências de modernização

Este arquivo lista o que falta atualizar no ERP com foco em **ambiente local**, sem preocupação com VPS/produção por enquanto. O objetivo aqui é tirar o sistema do estado legado: stack, dependências e frontend.

## Contexto atual (resumo)

- Stack: PHP 8.3, Laravel 12, Node 24, MariaDB 10.11 LTS. Decisão: **permanecer no Laravel 12**, sem migrar para o 13 — `eduardokum/laravel-boleto` (usado em `BoletoHelper`, `RemessaController`, `SellPosController`, `TransactionUtil`, `PaymentController`, `Api/CarrinhoController` para boleto/remessa CNAB de ~8 bancos) não suporta Laravel 13 em nenhuma versão, e não é candidato a shim (lógica específica por banco). Não é mais pendência a ser resolvida — só reavaliar se o pacote atualizar ou for substituído.
- Testes: suíte de 70 testes (`php8.3 artisan test`), banco dedicado `storeweb_test`, CI em `.github/workflows/ci.yml`.
- Frontend legado (Blade/AdminLTE/jQuery): pipeline de build restaurado (`resources/plugins/` → `public/js/vendor.js`/`public/css/vendor.css` via `npm run build`, ver `scripts/build-vendor-js.mjs`). jQuery **3.7.1** e Select2 **4.1.0** já atualizados dentro da mesma major. Bootstrap **3.3.7** e AdminLTE **2.4.18** ainda legados.

## Pendências

- [x] Dashboard/Home migrado para Vue 3 (2026-07-26): `resources/js/dashboard/` (build isolado via `vite.dashboard.config.js`, formato `iife` — necessário porque o bundle é carregado como `<script>` clássico, não `type="module"`; formato `es`/multi-entry vazava `var`s de topo para `window`, chegando a sobrescrever o `$` do jQuery). Backend expõe JSON puro em `/home/dashboard-charts`, `/home/product-stock-alert`, `/home/purchase-payment-dues`, `/home/sales-payment-dues` (antes eram Datatables server-side com HTML embutido). `dashboard_configurator/*` continua órfão/não usado, fora de escopo. `public/js/home.js` removido.
- [ ] Modernizar o restante da interface legada (AdminLTE/Bootstrap), incrementalmente, seção por seção:
  - Avaliar o salto AdminLTE v2 → v3/v4 junto com Bootstrap 3 → 5 (acoplados: AdminLTE 3/4 exige Bootstrap 4/5) — reescrita de classes/markup em larga escala.
  - Para cada nova seção, decidir caso a caso entre só atualizar Bootstrap/AdminLTE ou já migrar para Vue (seguindo o padrão criado pelo Dashboard: build Vite isolado por seção, formato `iife`, endpoints JSON dedicados reaproveitando escopo de permissão/`business_id` já existente no controller).
- [ ] Definir estratégia de frontend para o restante do sistema: manter Blade modernizado ou migrar módulos novos gradualmente para Vue. Não reescrever tudo de uma vez.

## Seções para modernizar (em ordem sugerida)

Levantamento dos `resources/views/*` agrupados por área de negócio, do maior uso/impacto para o menor. Cada seção vira um trabalho independente (mesmo padrão do Dashboard): decidir por seção se é só Bootstrap/AdminLTE ou já Vue, com endpoints JSON dedicados quando fizer sentido.

- [ ] **PDV / Vendas** — `sale_pos`, `sell`, `sell_return`. Tela mais usada do sistema (uso diário, alto volume de cliques); maior ganho percebido, mas também a mais arriscada (fluxo de caixa/POS não pode quebrar).
- [ ] **Produtos** — `product`, `variation`, `brand`, `unit`, `selling_price_group`, `labels`, `barcode`. Telas de cadastro/gestão, uso frequente.
- [ ] **Compras** — `purchase`, `purchase_return`, `purchase_xml`.
- [ ] **Contatos** — `contact`, `contatos`, `customer_group`.
- [ ] **Financeiro** — `account`, `account_types`, `account_reports`, `transaction_payment`, `revenues`, `expense`, `expense_category`.
- [ ] **Estoque** — `stock_adjustment`, `stock_transfer`, `opening_stock`, `import_opening_stock`.
- [ ] **Fiscal (NFe/NFCe/CTe/MDFe)** — `nfe`, `nfe_entrada`, `nfce`, `cte`, `mdfe`, `manifesto`, `naturezas`, `ibpt`. Telas mais técnicas/formulário-pesadas; baixa prioridade visual, mas checar se algum XML/preview embutido depende do jQuery legado antes de mexer.
- [ ] **Relatórios** — `report`. Muitas telas com DataTables/gráficos; bom candidato a reaproveitar o padrão de charts criado no Dashboard.
- [ ] **Configurações do negócio** — `business`, `business_location`, `location_settings`, `tax_group`, `tax_rate`, `printer`, `invoice_layout`, `invoice_scheme`, `notification_template`, `types_of_service`.
- [ ] **Usuários e permissões** — `user`, `role`, `manage_user`, `sales_commission_agent`.
- [ ] **E-commerce (admin da loja)** — `ecommerce`, `clientes_ecommerce`, `cupom`, `frete_gratis`, `carrossel`, `pedidos`, `informativo`. Painel administrativo interno; não confundir com o storefront público (`Api/CarrinhoController` etc.), que já é JSON e fora desse escopo.
- [ ] **Logística/parceiros** — `boletos`, `transportadoras`, `veiculos`, `banks`, `cities`, `enderecos`, `documents_and_notes`.
- [ ] **Restaurante** (se o módulo estiver em uso) — `restaurant`.
- [ ] **Baixa prioridade** — `backup`, `install`, `auth` (login/cadastro): telas de baixo tráfego ou uso único, deixar por último.

## Fora de escopo por agora

Só entra quando o projeto for para VPS: homologação SEFAZ real, backups/monitoramento de produção, HTTPS/domínio/WAF, LGPD comercial, teste de carga.