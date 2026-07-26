# Pendências de modernização

Este arquivo lista o que falta atualizar no ERP com foco em **ambiente local**, sem preocupação com VPS/produção por enquanto. O objetivo aqui é tirar o sistema do estado legado: stack, dependências e frontend.

## Contexto atual (resumo)

- Stack: PHP 8.3, Laravel 12, Node 24, MariaDB 10.11 LTS. Decisão: **permanecer no Laravel 12**, sem migrar para o 13 — `eduardokum/laravel-boleto` (usado em `BoletoHelper`, `RemessaController`, `SellPosController`, `TransactionUtil`, `PaymentController`, `Api/CarrinhoController` para boleto/remessa CNAB de ~8 bancos) não suporta Laravel 13 em nenhuma versão, e não é candidato a shim (lógica específica por banco). Não é mais pendência a ser resolvida — só reavaliar se o pacote atualizar ou for substituído.
- Testes: suíte de 70 testes (`php8.3 artisan test`), banco dedicado `storeweb_test`, CI em `.github/workflows/ci.yml`.
- Frontend legado (Blade/AdminLTE/jQuery): pipeline de build restaurado (`resources/plugins/` → `public/js/vendor.js`/`public/css/vendor.css` via `npm run build`, ver `scripts/build-vendor-js.mjs`). jQuery **3.7.1** e Select2 **4.1.0** já atualizados dentro da mesma major. Bootstrap **3.3.7** e AdminLTE **2.4.18** ainda legados.
- `laravelcollective/html` foi removido do projeto: os 260 arquivos Blade que usavam `Form::`/`Html::` foram migrados para componentes Blade nativos (`<x-form.*>`, ver `resources/views/components/form/`). Não é mais pendência.

## Pendências

- [ ] `nwidart/laravel-modules` preso em `^4.0` (instalado: `4.1.0`; atual do pacote é `^12`, `composer outdated` mostra `12.0.5` disponível). Não tem `illuminate/*` fixo no `composer.json`, então não bloqueia nada hoje — avaliar quando for pertinente. Outras deps com salto de major disponível (`composer outdated --direct`): `guzzlehttp/guzzle` 7.15.1→8.0.0, `laravel/tinker` 2.11.1→3.0.2, `mercadopago/dx-php` 2.6.2→3.12.1, `milon/barcode` 12.1.0→13.1, `nfephp-org/sped-da` 0.2.10→1.1.6, `phpmailer/phpmailer` 6.12.0→7.1.1, `spatie/laravel-backup` 9.4.1→9.3.6 (patch, sem risco), `stripe/stripe-php` 6.43.1→21.0.0.
- [ ] Modernizar interface legada (AdminLTE/Bootstrap), incrementalmente:
  - Avaliar o salto AdminLTE v2 → v3/v4 junto com Bootstrap 3 → 5 (acoplados: AdminLTE 3/4 exige Bootstrap 4/5) — reescrita de classes/markup em larga escala, candidato a ser feito por seção do sistema, não de uma vez.
  - Gráficos do dashboard (`HomeController`, `app/Charts/CommonChart.php`) já rodam em Chart.js (MIT) via `consoletvs/charts` — não é mais bloqueio para essa modernização.
  - Só depois decidir sobre migrar módulos novos para Vue/React (item abaixo) — faz sentido decidir isso depois que o Blade parar de depender do bundle legado.
- [ ] Definir estratégia de frontend: manter Blade modernizado ou migrar módulos novos gradualmente para Vue/React. Não reescrever tudo de uma vez.

## Fora de escopo por agora

Só entra quando o projeto for para VPS: homologação SEFAZ real, backups/monitoramento de produção, HTTPS/domínio/WAF, LGPD comercial, CI/CD de deploy, teste de carga.
