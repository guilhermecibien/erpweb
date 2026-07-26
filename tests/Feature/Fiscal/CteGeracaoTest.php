<?php

namespace Tests\Feature\Fiscal;

use App\Models\City;
use App\Models\Contact;
use App\Models\Cte;
use App\Models\NaturezaOperacao;
use App\Models\Veiculo;
use App\Models\Business;
use App\Services\CTeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\Concerns\CreatesFiscalCertificate;
use Tests\TestCase;

/**
 * Testa apenas a MONTAGEM/ESTRUTURA do XML do CT-e (App\Services\CTeService::gerarCTe),
 * sem assinar/transmitir/consultar/cancelar - isso depende de rede real com a SEFAZ
 * e fica fora de escopo (ver PENDENCIAS_MODERNIZACAO.md).
 *
 * A rota HTTP /cte/gerarXml/{id} é usada como ponto de entrada porque ela passa
 * pelo middleware SetSessionData, que é quem popula a sessão `user.business_id`
 * de que CTeService::gerarCTe depende (via request()->session()->get(...)).
 */
class CteGeracaoTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;
    use CreatesFiscalCertificate;

    protected $seed = true;

    private $business;
    private $admin;
    private $location;

    protected function setUp(): void
    {
        parent::setUp();

        [$this->business, $this->admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_cte',
            'password' => 'secret123',
        ]);

        config(['constants.administrator_usernames' => 'admin_cte']);

        $cidadeEmitente = City::where('uf', 'SP')->firstOrFail();

        $this->business->razao_social = 'Transportadora Teste LTDA';
        $this->business->cnpj = '00.000.000/0001-91';
        $this->business->ie = '110042490114';
        $this->business->ambiente = 2; // homologação
        $this->business->regime = 1;
        $this->business->rua = 'Rua Teste';
        $this->business->numero = '100';
        $this->business->bairro = 'Centro';
        $this->business->cep = '01000-000';
        $this->business->telefone = '11999999999';
        $this->business->cidade_id = $cidadeEmitente->id;
        $this->business->csc = 'CSC-TESTE';
        $this->business->csc_id = '1';
        $this->business->save();

        $this->setFiscalCertificateOn($this->business);

        $this->location = $this->business->locations()->first();
    }

    private function createVeiculo(): Veiculo
    {
        return Veiculo::create([
            'business_id' => $this->business->id,
            'placa' => 'ABC1234',
            'uf' => 'SP',
            'cor' => 'Branco',
            'marca' => 'Volvo',
            'modelo' => 'FH',
            'rntrc' => '12345678901',
            'tipo' => '01',
            'tipo_carroceira' => '01',
            'tipo_rodado' => '01',
            'tara' => '5000',
            'capacidade' => '30000',
            'proprietario_documento' => '12345678000199',
            'proprietario_nome' => 'Dono do Veiculo LTDA',
            'proprietario_ie' => '110042490114',
            'proprietario_uf' => 'SP',
            'proprietario_tp' => 1,
        ]);
    }

    private function createNatureza(array $overrides = []): NaturezaOperacao
    {
        return NaturezaOperacao::create(array_merge([
            'business_id' => $this->business->id,
            'natureza' => 'Prestacao de servico de transporte',
            'cfop_entrada_estadual' => '1353',
            'cfop_entrada_inter_estadual' => '2353',
            'cfop_saida_estadual' => '5353',
            'cfop_saida_inter_estadual' => '6353',
            'finNFe' => 1,
            'tipo' => 1,
            'sobrescreve_cfop' => 0,
        ], $overrides));
    }

    private function createContact(City $cidade, string $name): Contact
    {
        return Contact::create([
            'business_id' => $this->business->id,
            'city_id' => $cidade->id,
            'cpf_cnpj' => '12345678000199',
            'ie_rg' => '110042490114',
            'rua' => 'Rua do Contato',
            'numero' => '50',
            'bairro' => 'Bairro Contato',
            'cep' => '02000-000',
            'type' => 'customer',
            'name' => $name,
            'mobile' => '11988887777',
            'created_by' => $this->admin->id,
        ]);
    }

    private function createCte(array $overrides = []): Cte
    {
        $municipioEnvio = City::where('uf', 'SP')->firstOrFail();
        $municipioInicio = City::where('uf', 'SP')->skip(1)->firstOrFail();
        $municipioFim = City::where('uf', 'RJ')->firstOrFail();

        $remetente = $this->createContact($municipioInicio, 'Remetente Teste');
        $destinatario = $this->createContact($municipioFim, 'Destinatario Teste');
        $natureza = $this->createNatureza();
        $veiculo = $this->createVeiculo();

        return Cte::create(array_merge([
            'business_id' => $this->business->id,
            'location_id' => $this->location->id,
            'chave_nfe' => '',
            'remetente_id' => $remetente->id,
            'destinatario_id' => $destinatario->id,
            'usuario_id' => $this->admin->id,
            'natureza_id' => $natureza->id,
            'tomador' => 0, // Remetente
            'municipio_envio' => $municipioEnvio->id,
            'municipio_inicio' => $municipioInicio->id,
            'municipio_fim' => $municipioFim->id,
            'logradouro_tomador' => 'Rua Tomador',
            'numero_tomador' => '1',
            'bairro_tomador' => 'Bairro Tomador',
            'cep_tomador' => '01000-000',
            'municipio_tomador' => $municipioInicio->id,
            'valor_transporte' => 1000,
            'valor_receber' => 1000,
            'valor_carga' => 5000,
            'produto_predominante' => 'Carga geral',
            'data_previsata_entrega' => now()->addDays(3)->format('Y-m-d'),
            'observacao' => 'CT-e de teste',
            'sequencia_cce' => 0,
            'cte_numero' => 0,
            'chave' => '',
            'path_xml' => '',
            'estado' => 'NOVO',
            'retira' => 0,
            'detalhes_retira' => '',
            'modal' => '01',
            'veiculo_id' => $veiculo->id,
            'tpDoc' => '',
            'descOutros' => '',
            'nDoc' => 0,
            'vDocFisc' => 0,
            'globalizado' => 0,
            'cst' => '00',
            'perc_icms' => 12,
        ], $overrides));
    }

    public function test_gerar_xml_monta_um_cte_bem_formado_com_as_tags_esperadas()
    {
        $cte = $this->createCte();

        $response = $this->actingAs($this->admin)->get('/cte/gerarXml/' . $cte->id);

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml');

        $xml = $response->getContent();

        // Não deve conter o marcador de erro usado pela própria rota
        // (CteController::gerarXml faz `echo $e . "<br>"` em caso de xml_erros).
        $this->assertStringNotContainsString('<br>', $xml);

        $sxml = new \SimpleXMLElement($xml);

        $this->assertSame('CTe', $sxml->getName());
        $this->assertTrue(isset($sxml->infCte), 'Tag infCte ausente no CT-e gerado.');
        $this->assertTrue(isset($sxml->infCte->rem), 'Tag rem (remetente) ausente no CT-e gerado.');
        $this->assertTrue(isset($sxml->infCte->dest), 'Tag dest (destinatario) ausente no CT-e gerado.');
        $this->assertTrue(isset($sxml->infCte->emit), 'Tag emit (emitente) ausente no CT-e gerado.');
        $this->assertTrue(isset($sxml->infCte->ide), 'Tag ide ausente no CT-e gerado.');

        // Como o remetente e o destinatário estão em UFs diferentes (SP/RJ), o
        // CFOP de saída deve ser o interestadual configurado na natureza de operação.
        $this->assertSame('6353', (string) $sxml->infCte->ide->CFOP);
    }

    /**
     * O município de destino não pode ser inexistente de fato (a coluna
     * `municipio_fim` tem FK para `cities`), então simulamos o cenário
     * mutando o atributo em memória (sem salvar) e chamando o Service
     * diretamente - CTeService::gerarCTe faz `City::find($cte->municipio_fim)`
     * e retorna 'xml_erros' quando o resultado é nulo.
     *
     * A sessão `user.business_id` (da qual gerarCTe depende) é populada
     * visitando a rota HTTP real antes de chamar o Service diretamente.
     */
    public function test_gerar_cte_retorna_erro_quando_municipio_da_prestacao_nao_e_encontrado()
    {
        $cte = $this->createCte();

        $this->actingAs($this->admin)
            ->get('/cte/gerarXml/' . $cte->id)
            ->assertOk();

        $cte->municipio_fim = 999999;

        $config = Business::getConfigCte($this->business->id, $cte);
        $service = new CTeService($this->buildCteServiceConfig($config), $config);

        $gerado = $service->gerarCTe($cte);

        $this->assertArrayHasKey('xml_erros', $gerado);
        $this->assertContains(
            'Município de envio, início ou fim da prestação não informado corretamente.',
            $gerado['xml_erros']
        );
    }

    private function buildCteServiceConfig(Business $config): array
    {
        return [
            'atualizacao' => date('Y-m-d h:i:s'),
            'tpAmb' => (int) $config->ambiente,
            'razaosocial' => $config->razao_social,
            'siglaUF' => $config->cidade->uf,
            'cnpj' => preg_replace('/[^0-9]/', '', $config->cnpj),
            'schemes' => 'PL_CTe_400',
            'versao' => '4.00',
            'CSC' => $config->csc,
            'CSCid' => $config->csc_id,
        ];
    }

    public function test_usuario_de_outro_negocio_nao_acessa_cte_de_outra_empresa()
    {
        $cte = $this->createCte();

        [, $outroAdmin] = $this->createBusinessWithAdmin([
            'username' => 'admin_cte_outro',
            'password' => 'secret123',
        ]);
        config(['constants.administrator_usernames' => 'admin_cte,admin_cte_outro']);

        $this->actingAs($outroAdmin)
            ->get('/cte/gerarXml/' . $cte->id)
            ->assertForbidden();
    }
}
