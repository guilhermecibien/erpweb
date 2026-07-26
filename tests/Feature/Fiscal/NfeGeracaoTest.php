<?php

namespace Tests\Feature\Fiscal;

use App\Models\City;
use App\Models\Contact;
use App\Models\NaturezaOperacao;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\Concerns\CreatesFiscalCertificate;
use Tests\Concerns\CreatesStockedProduct;
use Tests\TestCase;

/**
 * Testa apenas a MONTAGEM/ESTRUTURA do XML da NF-e (App\Services\NFeService::gerarNFe),
 * sem assinar/transmitir/consultar/cancelar - depende de rede real com a SEFAZ e
 * fica fora de escopo (ver PENDENCIAS_MODERNIZACAO.md). A venda usada como base é
 * criada da mesma forma que em Tests\Feature\Sales\SellPosControllerTest (via
 * POST /pos), para reaproveitar o fluxo de venda já validado por aquele teste.
 */
class NfeGeracaoTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;
    use CreatesStockedProduct;
    use CreatesFiscalCertificate;

    protected $seed = true;

    private $business;
    private $admin;
    private $location;

    protected function setUp(): void
    {
        parent::setUp();

        [$this->business, $this->admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_nfe',
            'password' => 'secret123',
        ]);
        $this->createActiveSubscription($this->business, $this->admin);

        config(['constants.administrator_usernames' => 'admin_nfe']);

        $cidadeEmitente = City::where('uf', 'SP')->firstOrFail();

        $this->business->razao_social = 'Comercio Teste LTDA';
        $this->business->cnpj = '00.000.000/0001-91';
        $this->business->ie = '110042490114';
        $this->business->ambiente = 2; // homologação
        $this->business->regime = 1; // simples nacional
        $this->business->rua = 'Rua Teste';
        $this->business->numero = '100';
        $this->business->bairro = 'Centro';
        $this->business->cep = '01000-000';
        $this->business->telefone = '11999999999';
        $this->business->cidade_id = $cidadeEmitente->id;
        $this->business->csc = 'CSC-TESTE';
        $this->business->csc_id = '1';
        $this->business->numero_serie_nfe = 1;
        $this->business->save();

        $this->setFiscalCertificateOn($this->business);

        $this->location = $this->business->locations()->first();
    }

    private function cashPaymentPayload(string $amount): array
    {
        return [
            'method' => 'cash',
            'amount' => $amount,
            'note' => '',
            'card_transaction_number' => '',
            'card_number' => '',
            'card_type' => '',
            'card_holder_name' => '',
            'card_month' => '',
            'card_year' => '',
            'card_security' => '',
            'cheque_number' => '',
            'bank_account_number' => '',
            'is_return' => 0,
            'transaction_no' => '',
            'data_base' => now()->format('d/m/Y'),
            'intervalo' => '',
            'vencimento' => now()->format('d/m/Y'),
            'qtd_parcelas' => 1,
        ];
    }

    /**
     * Cria uma venda válida (mesmo fluxo de Tests\Feature\Sales\SellPosControllerTest)
     * e a associa a uma natureza de operação, requisito para a montagem da NF-e
     * (NFeService::gerarNFe lê $venda->natureza em várias tags).
     */
    private function createSale(): Transaction
    {
        [$product, $variation] = $this->createStockedProduct($this->business, $this->admin, $this->location, 20);
        $customer = Contact::where('business_id', $this->business->id)->where('is_default', 1)->firstOrFail();

        $payload = [
            'is_direct_sale' => 1,
            'status' => 'final',
            'location_id' => $this->location->id,
            'contact_id' => $customer->id,
            'transaction_date' => now()->format('d/m/Y H:i'),
            'discount_type' => 'fixed',
            'discount_amount' => '0',
            'tax_rate_id' => '',
            'final_total' => '30',
            'valor_recebido' => '30',
            'change_return' => '0',
            'products' => [
                [
                    'product_id' => $product->id,
                    'variation_id' => $variation->id,
                    'quantity' => '3',
                    'unit_price' => '10',
                    'unit_price_inc_tax' => '10',
                    'item_tax' => '0',
                    'tax_id' => null,
                    'enable_stock' => 1,
                    'product_type' => 'single',
                ],
            ],
            'payment' => [
                $this->cashPaymentPayload('30'),
            ],
        ];

        $this->actingAs($this->admin)
            ->post('/pos', $payload)
            ->assertRedirect(action('SellController@index'));

        $sale = Transaction::where('business_id', $this->business->id)->where('type', 'sell')->firstOrFail();

        $natureza = NaturezaOperacao::create([
            'business_id' => $this->business->id,
            'natureza' => 'Venda de mercadoria adquirida ou produzida',
            'cfop_entrada_estadual' => '1102',
            'cfop_entrada_inter_estadual' => '2102',
            'cfop_saida_estadual' => '5102',
            'cfop_saida_inter_estadual' => '6102',
            'finNFe' => 1,
            'tipo' => 1,
            'sobrescreve_cfop' => 0,
        ]);

        $sale->natureza_id = $natureza->id;
        $sale->estado = 'NOVO';
        $sale->save();

        return $sale->fresh();
    }

    public function test_gerar_xml_monta_uma_nfe_bem_formada_com_as_tags_esperadas()
    {
        $sale = $this->createSale();

        $response = $this->actingAs($this->admin)->get('/nfe/gerarXml/' . $sale->id);

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml');

        $xml = $response->getContent();
        $this->assertStringNotContainsString('<br>', $xml);

        $sxml = new \SimpleXMLElement($xml);

        $this->assertSame('NFe', $sxml->getName());
        $this->assertTrue(isset($sxml->infNFe), 'Tag infNFe ausente na NF-e gerada.');
        $this->assertTrue(isset($sxml->infNFe->emit), 'Tag emit ausente na NF-e gerada.');
        $this->assertTrue(isset($sxml->infNFe->dest), 'Tag dest (destinatario) ausente na NF-e gerada.');
        $this->assertTrue(isset($sxml->infNFe->det), 'Tag det (item da nota) ausente na NF-e gerada.');
        $this->assertSame('55', (string) $sxml->infNFe->ide->mod);
    }

    public function test_gerar_xml_retorna_forbidden_para_venda_de_outra_empresa()
    {
        $sale = $this->createSale();

        [, $outroAdmin] = $this->createBusinessWithAdmin([
            'username' => 'admin_nfe_outro',
            'password' => 'secret123',
        ]);
        config(['constants.administrator_usernames' => 'admin_nfe,admin_nfe_outro']);

        // createSale() já logou como $this->admin (business A) para criar a venda via
        // POST /pos; SetSessionData só popula a sessão 'user' quando ela ainda não
        // existe, então sem o flush aqui o outroAdmin herdaria o business_id de A.
        $this->flushSession();

        $this->actingAs($outroAdmin)
            ->get('/nfe/gerarXml/' . $sale->id)
            ->assertForbidden();
    }
}
