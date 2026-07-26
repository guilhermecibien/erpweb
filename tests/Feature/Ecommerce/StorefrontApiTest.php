<?php

namespace Tests\Feature\Ecommerce;

use App\Models\ClienteEcommerce;
use App\Models\ConfigEcommerce;
use App\Models\EnderecoEcommerce;
use App\Models\PedidoEcommerce;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\Concerns\CreatesStockedProduct;
use Tests\TestCase;

/**
 * Public storefront API (routes/api.php, middleware authEcommerce) - the
 * actual cart-to-checkout flow. authEcommerce resolves the business from a
 * ConfigEcommerce row matched by the "Authorization" header (not related to
 * the ERP's own user auth/session).
 */
class StorefrontApiTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;
    use CreatesStockedProduct;

    protected $seed = true;

    private function createStoreConfig($business, string $token = 'loja-token-teste'): ConfigEcommerce
    {
        return ConfigEcommerce::create([
            'business_id' => $business->id,
            'nome' => 'Loja Teste',
            'rua' => 'Rua Teste',
            'numero' => '1',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'cep' => '01000-000',
            'telefone' => '11999999999',
            'email' => 'loja@example.com',
            'link_facebook' => '',
            'link_twiter' => '',
            'link_instagram' => '',
            'frete_gratis_valor' => 500,
            'mercadopago_public_key' => '',
            'mercadopago_access_token' => '',
            'funcionamento' => '08h-18h',
            'latitude' => '-23.55',
            'longitude' => '-46.63',
            'politica_privacidade' => 'Política de teste',
            'token' => $token,
            'mensagem_agradecimento' => 'Obrigado pela compra!',
        ]);
    }

    public function test_requests_without_a_valid_storefront_token_are_rejected()
    {
        $this->postJson('/api/clientes/login', [
            'email' => 'nao@existe.com',
            'senha' => 'x',
        ])->assertStatus(404);
    }

    public function test_customer_can_register_with_an_address()
    {
        [$business] = $this->createBusinessWithAdmin();
        $config = $this->createStoreConfig($business);

        $response = $this->postJson('/api/clientes/salvar', [
            'cliente' => [
                'nome' => 'Maria',
                'sobre_nome' => 'Silva',
                'cpf' => '12345678900',
                'email' => 'maria@example.com',
                'telefone' => '11988887777',
                'senha' => 'secret123',
                'rua' => 'Rua das Flores',
                'numero' => '10',
                'bairro' => 'Jardim',
                'cep' => '02000-000',
                'cidade' => 'São Paulo',
                'uf' => 'SP',
            ],
        ], ['Authorization' => $config->token]);

        $response->assertOk();
        $response->assertJsonStructure(['token', 'nome']);

        $cliente = ClienteEcommerce::where('business_id', $business->id)
            ->where('email', 'maria@example.com')
            ->firstOrFail();

        $this->assertEquals(md5('secret123'), $cliente->senha);

        $this->assertDatabaseHas('endereco_ecommerces', [
            'cliente_id' => $cliente->id,
            'cidade' => 'São Paulo',
        ]);
    }

    public function test_customer_can_login_with_valid_credentials_and_not_with_wrong_password()
    {
        [$business] = $this->createBusinessWithAdmin();
        $config = $this->createStoreConfig($business);

        $cliente = ClienteEcommerce::create([
            'business_id' => $business->id,
            'nome' => 'João',
            'sobre_nome' => 'Souza',
            'cpf' => '98765432100',
            'email' => 'joao@example.com',
            'telefone' => '11977776666',
            'senha' => md5('minhasenha'),
            'token' => 'cliente-token-joao',
        ]);

        $this->postJson('/api/clientes/login', [
            'email' => 'joao@example.com',
            'senha' => 'errada',
        ], ['Authorization' => $config->token])
            ->assertStatus(404);

        $this->postJson('/api/clientes/login', [
            'email' => 'joao@example.com',
            'senha' => 'minhasenha',
        ], ['Authorization' => $config->token])
            ->assertOk()
            ->assertJson(['token' => $cliente->token, 'nome' => 'João']);
    }

    public function test_customer_can_add_a_new_address()
    {
        [$business] = $this->createBusinessWithAdmin();
        $config = $this->createStoreConfig($business);

        $cliente = ClienteEcommerce::create([
            'business_id' => $business->id,
            'nome' => 'Ana',
            'sobre_nome' => 'Lima',
            'cpf' => '11122233344',
            'email' => 'ana@example.com',
            'telefone' => '11955554444',
            'senha' => md5('secret123'),
            'token' => 'cliente-token-ana',
        ]);

        $this->postJson('/api/enderecos/salvar', [
            'token' => $cliente->token,
            'endereco' => [
                'rua' => 'Rua Nova',
                'numero' => '20',
                'bairro' => 'Vila Nova',
                'cep' => '03000-000',
                'cidade' => 'Campinas',
                'uf' => 'SP',
            ],
        ], ['Authorization' => $config->token])
            ->assertOk()
            ->assertSee('ok');

        $this->assertDatabaseHas('endereco_ecommerces', [
            'cliente_id' => $cliente->id,
            'cidade' => 'Campinas',
        ]);
    }

    public function test_cart_checkout_creates_a_pending_order_with_its_items()
    {
        [$business, $admin] = $this->createBusinessWithAdmin();
        $config = $this->createStoreConfig($business);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 20);

        $cliente = ClienteEcommerce::create([
            'business_id' => $business->id,
            'nome' => 'Carla',
            'sobre_nome' => 'Rocha',
            'cpf' => '55566677788',
            'email' => 'carla@example.com',
            'telefone' => '11933332222',
            'senha' => md5('secret123'),
            'token' => 'cliente-token-carla',
        ]);
        $endereco = EnderecoEcommerce::create([
            'cliente_id' => $cliente->id,
            'rua' => 'Rua da Entrega',
            'numero' => '5',
            'bairro' => 'Centro',
            'cep' => '04000-000',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
        ]);

        $response = $this->postJson('/api/carrinho/salvarPedido', [
            'data' => [
                'cliente' => ['id' => $cliente->id],
                'endereco' => ['id' => $endereco->id],
                'carrinho' => [
                    ['id' => $product->id, 'quantidade' => 2, 'variacao_id' => $variation->id],
                ],
                'total' => 20,
                'valor_frete' => 5,
                'tipo_frete' => 'PAC',
                'valor_desconto' => 0,
            ],
        ], ['Authorization' => $config->token]);

        $response->assertOk();
        $token = $response->json();
        $this->assertIsString($token);

        $pedido = PedidoEcommerce::where('token', $token)->firstOrFail();
        $this->assertEquals($business->id, $pedido->business_id);
        $this->assertEquals($cliente->id, $pedido->cliente_id);
        $this->assertEquals($endereco->id, $pedido->endereco_id);
        $this->assertEquals(0, $pedido->status);
        $this->assertEquals(25, (float) $pedido->valor_total);

        $this->assertDatabaseHas('item_pedido_ecommerces', [
            'pedido_id' => $pedido->id,
            'produto_id' => $product->id,
            'variacao_id' => $variation->id,
            'quantidade' => 2,
        ]);

        $getResponse = $this->getJson('/api/carrinho/getPedido?token=' . $token, [
            'Authorization' => $config->token,
        ]);
        $getResponse->assertOk();
        $getResponse->assertJsonPath('id', $pedido->id);
    }
}
