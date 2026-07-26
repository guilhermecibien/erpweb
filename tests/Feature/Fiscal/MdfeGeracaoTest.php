<?php

namespace Tests\Feature\Fiscal;

use App\Models\City;
use App\Models\Mdfe;
use App\Models\Veiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\Concerns\CreatesFiscalCertificate;
use Tests\TestCase;

/**
 * Testa apenas a MONTAGEM/ESTRUTURA do XML do MDF-e (App\Services\MdfeService::gerarMDFe),
 * sem assinar/transmitir/consultar/cancelar - depende de rede real com a SEFAZ e
 * fica fora de escopo (ver PENDENCIAS_MODERNIZACAO.md).
 */
class MdfeGeracaoTest extends TestCase
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
            'username' => 'admin_mdfe',
            'password' => 'secret123',
        ]);

        config(['constants.administrator_usernames' => 'admin_mdfe']);

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

    private function createVeiculo(array $overrides = []): Veiculo
    {
        return Veiculo::create(array_merge([
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
        ], $overrides));
    }

    private function createMdfe(array $overrides = []): Mdfe
    {
        $veiculoTracao = $this->createVeiculo();

        return Mdfe::create(array_merge([
            'business_id' => $this->business->id,
            'location_id' => $this->location->id,
            'uf_inicio' => 'SP',
            'uf_fim' => 'RJ',
            'encerrado' => 0,
            'data_inicio_viagem' => now()->format('Y-m-d'),
            'carga_posterior' => 0,
            'cnpj_contratante' => '',
            'veiculo_tracao_id' => $veiculoTracao->id,
            'estado' => 'NOVO',
            'mdfe_numero' => 0,
            'chave' => '',
            'protocolo' => '',
            'seguradora_nome' => '',
            'seguradora_cnpj' => '',
            'numero_apolice' => '',
            'numero_averbacao' => '',
            'valor_carga' => 5000,
            'quantidade_carga' => 1000,
            'info_complementar' => '',
            'info_adicional_fisco' => '',
            'condutor_nome' => 'Condutor Teste',
            'condutor_cpf' => '123.456.789-00',
            'lac_rodo' => '',
            'tp_emit' => 1,
            'tp_transp' => 1,
            'produto_pred_nome' => 'Carga geral',
            'produto_pred_ncm' => '00000000',
            'produto_pred_cod_barras' => '',
            'cep_carrega' => '01000000',
            'cep_descarrega' => '20000000',
            'tp_carga' => '05',
        ], $overrides));
    }

    public function test_gerar_xml_monta_um_mdfe_bem_formado_com_as_tags_esperadas()
    {
        $mdfe = $this->createMdfe();

        $response = $this->actingAs($this->admin)->get('/mdfe/gerarXml/' . $mdfe->id);

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml');

        $xml = $response->getContent();
        $this->assertStringNotContainsString('<br>', $xml);

        $sxml = new \SimpleXMLElement($xml);

        $this->assertSame('MDFe', $sxml->getName());
        $this->assertTrue(isset($sxml->infMDFe), 'Tag infMDFe ausente no MDF-e gerado.');
        $this->assertTrue(isset($sxml->infMDFe->ide), 'Tag ide ausente no MDF-e gerado.');
        $this->assertTrue(isset($sxml->infMDFe->emit), 'Tag emit ausente no MDF-e gerado.');
        $this->assertTrue(isset($sxml->infMDFe->infModal), 'Tag infModal ausente no MDF-e gerado.');

        $this->assertSame('SP', (string) $sxml->infMDFe->ide->UFIni);
        $this->assertSame('RJ', (string) $sxml->infMDFe->ide->UFFim);
    }

    public function test_gerar_xml_retorna_forbidden_para_mdfe_de_outra_empresa()
    {
        $mdfe = $this->createMdfe();

        [, $outroAdmin] = $this->createBusinessWithAdmin([
            'username' => 'admin_mdfe_outro',
            'password' => 'secret123',
        ]);
        config(['constants.administrator_usernames' => 'admin_mdfe,admin_mdfe_outro']);

        $this->actingAs($outroAdmin)
            ->get('/mdfe/gerarXml/' . $mdfe->id)
            ->assertForbidden();
    }
}
