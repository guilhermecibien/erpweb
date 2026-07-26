<?php

namespace Tests\Feature\Ecommerce;

use App\Models\City;
use App\Models\ClienteEcommerce;
use App\Models\ConfigEcommerce;
use App\Models\Contact;
use App\Models\EnderecoEcommerce;
use App\Models\ItemPedidoEcommerce;
use App\Models\PedidoEcommerce;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\Concerns\CreatesStockedProduct;
use Tests\TestCase;

/**
 * ERP-side (authenticated painel) management of the e-commerce store:
 * store config, customer/address records, and converting an already-placed
 * PedidoEcommerce into a formal ERP sale.
 */
class EcommerceAdminTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;
    use CreatesStockedProduct;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        config(['constants.administrator_usernames' => implode(',', [
            'admin_ecommerce',
            'no_perm_ecommerce',
        ])]);
    }

    private function createNoPermUser($business, $username)
    {
        $user = User::create_user([
            'surname' => '',
            'first_name' => 'Sem',
            'last_name' => 'Permissao',
            'username' => $username,
            'email' => $username . '@example.com',
            'password' => 'secret123',
            'language' => 'pt',
        ]);
        $user->business_id = $business->id;
        $user->save();

        return $user->fresh();
    }

    private function storeConfigPayload(): array
    {
        return [
            'nome' => 'Loja Teste',
            'rua' => 'Rua Teste',
            'numero' => '1',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'cep' => '01000-000',
            'telefone' => '11999999999',
            'email' => 'loja@example.com',
            'mercadopago_public_key' => 'pk-test',
            'mercadopago_access_token' => 'token-test',
            'funcionamento' => '08h-18h',
            'latitude' => '-23.55',
            'longitude' => '-46.63',
            'token' => 'loja-token',
            'timer_carrossel' => 5,
            'frete_gratis_valor' => '500',
            'mensagem_agradecimento' => 'Obrigado!',
        ];
    }

    public function test_admin_can_create_and_then_update_the_store_config()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_ecommerce',
            'password' => 'secret123',
        ]);

        $this->actingAs($admin)
            ->post('/ecommerce/save', $this->storeConfigPayload())
            ->assertRedirect('/ecommerce/config');

        $config = ConfigEcommerce::where('business_id', $business->id)->firstOrFail();
        $this->assertEquals('Loja Teste', $config->nome);

        $updatePayload = array_merge($this->storeConfigPayload(), ['nome' => 'Loja Atualizada']);

        $this->actingAs($admin)
            ->post('/ecommerce/save', $updatePayload)
            ->assertRedirect('/ecommerce/config');

        $this->assertDatabaseHas('config_ecommerces', [
            'business_id' => $business->id,
            'nome' => 'Loja Atualizada',
        ]);
        $this->assertEquals(1, ConfigEcommerce::where('business_id', $business->id)->count());
    }

    public function test_no_perm_user_cannot_manage_ecommerce_customers()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_ecommerce',
            'password' => 'secret123',
        ]);
        $viewer = $this->createNoPermUser($business, 'no_perm_ecommerce');

        $this->actingAs($viewer)
            ->get('/clienteEcommerce')
            ->assertForbidden();

        $this->actingAs($admin)
            ->get('/clienteEcommerce')
            ->assertOk();
    }

    public function test_admin_can_create_update_and_delete_an_ecommerce_customer()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_ecommerce',
            'password' => 'secret123',
        ]);

        $this->actingAs($admin)
            ->post('/clienteEcommerce/save', [
                'nome' => 'Cliente',
                'sobre_nome' => 'Teste',
                'email' => 'cliente@example.com',
                'cpf' => '11144477735',
                'telefone' => '11988887777',
                'senha' => 'secret123',
            ])
            ->assertRedirect('/clienteEcommerce');

        $cliente = ClienteEcommerce::where('business_id', $business->id)
            ->where('email', 'cliente@example.com')
            ->firstOrFail();

        $this->actingAs($admin)
            ->put('/clienteEcommerce/update/' . $cliente->id, [
                'nome' => 'Cliente Atualizado',
                'sobre_nome' => 'Teste',
                'email' => 'cliente@example.com',
                'cpf' => '111.444.777-35',
                'telefone' => '11988887777',
                'status' => 1,
                'senha' => '',
            ])
            ->assertRedirect('/clienteEcommerce');

        $this->assertDatabaseHas('cliente_ecommerces', [
            'id' => $cliente->id,
            'nome' => 'Cliente Atualizado',
            'cpf' => '11144477735',
        ]);

        $this->actingAs($admin)
            ->delete('/clienteEcommerce/delete/' . $cliente->id, [], ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('cliente_ecommerces', ['id' => $cliente->id]);
    }

    public function test_admin_can_list_and_edit_a_customer_address()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_ecommerce',
            'password' => 'secret123',
        ]);

        $cliente = ClienteEcommerce::create([
            'business_id' => $business->id,
            'nome' => 'Cliente',
            'sobre_nome' => 'Teste',
            'cpf' => '12345678900',
            'email' => 'cliente2@example.com',
            'telefone' => '11988887777',
            'senha' => md5('secret123'),
            'token' => 'cliente-token',
        ]);
        $endereco = EnderecoEcommerce::create([
            'cliente_id' => $cliente->id,
            'rua' => 'Rua Antiga',
            'numero' => '1',
            'bairro' => 'Centro',
            'cep' => '01000-000',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
        ]);

        $this->actingAs($admin)
            ->get('/enderecosEcommerce/' . $cliente->id)
            ->assertOk();

        $city = City::create(['codigo' => '1', 'nome' => 'Campinas', 'uf' => 'SP']);

        $this->actingAs($admin)
            ->post('/enderecosEcommerce/update', [
                'id' => $endereco->id,
                'city_id' => $city->id,
                'rua' => 'Rua Nova',
                'numero' => '2',
                'bairro' => 'Vila Nova',
                'cep' => '02000-000',
                'cidade' => 'Campinas',
                'uf' => 'SP',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('endereco_ecommerces', [
            'id' => $endereco->id,
            'cidade' => 'Campinas',
            'rua' => 'Rua Nova',
        ]);
    }

    public function test_no_perm_user_cannot_access_ecommerce_orders_index()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_ecommerce',
            'password' => 'secret123',
        ]);
        $viewer = $this->createNoPermUser($business, 'no_perm_ecommerce');

        $this->actingAs($viewer)
            ->get('/pedidosEcommerce')
            ->assertForbidden();
    }

    public function test_admin_can_view_a_placed_order()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_ecommerce',
            'password' => 'secret123',
        ]);

        $cliente = ClienteEcommerce::create([
            'business_id' => $business->id,
            'nome' => 'Cliente',
            'sobre_nome' => 'Teste',
            'cpf' => '12345678900',
            'email' => 'cliente3@example.com',
            'telefone' => '11988887777',
            'senha' => md5('secret123'),
            'token' => 'cliente-token-3',
        ]);
        $endereco = EnderecoEcommerce::create([
            'cliente_id' => $cliente->id,
            'rua' => 'Rua Teste',
            'numero' => '1',
            'bairro' => 'Centro',
            'cep' => '01000-000',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
        ]);
        $pedido = PedidoEcommerce::create([
            'business_id' => $business->id,
            'cliente_id' => $cliente->id,
            'endereco_id' => $endereco->id,
            'status' => 1,
            'valor_total' => '50',
            'valor_frete' => '0',
            'valor_desconto' => '0',
            'tipo_frete' => 'PAC',
            'observacao' => '',
            'rand_pedido' => 'rp1',
            'link_boleto' => '',
            'qr_code_base64' => '',
            'qr_code' => '',
            'token' => 'pedido-token-1',
        ]);

        $this->actingAs($admin)
            ->get('/pedidosEcommerce/ver/' . $pedido->id)
            ->assertOk();
    }

    public function test_placed_order_can_be_converted_into_an_erp_sale()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_ecommerce',
            'password' => 'secret123',
        ]);

        $location = $business->locations()->first();
        [$product, $variation] = $this->createStockedProduct($business, $admin, $location, 20);

        City::create(['codigo' => '1', 'nome' => 'São Paulo', 'uf' => 'SP']);

        $cliente = ClienteEcommerce::create([
            'business_id' => $business->id,
            'nome' => 'Cliente',
            'sobre_nome' => 'Final',
            'cpf' => '12345678900',
            'email' => 'cliente4@example.com',
            'telefone' => '11988887777',
            'senha' => md5('secret123'),
            'token' => 'cliente-token-4',
        ]);
        $endereco = EnderecoEcommerce::create([
            'cliente_id' => $cliente->id,
            'rua' => 'Rua Teste',
            'numero' => '1',
            'bairro' => 'Centro',
            'cep' => '01000-000',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
        ]);
        $pedido = PedidoEcommerce::create([
            'business_id' => $business->id,
            'cliente_id' => $cliente->id,
            'endereco_id' => $endereco->id,
            'status' => 1,
            'valor_total' => '20',
            'valor_frete' => '0',
            'valor_desconto' => '0',
            'tipo_frete' => 'PAC',
            'forma_pagamento' => 'Pix',
            'observacao' => '',
            'rand_pedido' => 'rp2',
            'link_boleto' => '',
            'qr_code_base64' => '',
            'qr_code' => '',
            'token' => 'pedido-token-2',
        ]);
        ItemPedidoEcommerce::create([
            'pedido_id' => $pedido->id,
            'produto_id' => $product->id,
            'quantidade' => 2,
            'variacao_id' => $variation->id,
        ]);

        $this->actingAs($admin)
            ->post('/pedidosEcommerce/salvarVenda', [
                'id' => $pedido->id,
                'location_id' => $location->id,
                'frete' => 'PAC',
                'valor_frete' => 0,
            ])
            ->assertRedirect('sells');

        $venda = Transaction::where('business_id', $business->id)
            ->where('pedido_ecommerce_id', $pedido->id)
            ->firstOrFail();

        $this->assertEquals('sell', $venda->type);
        $this->assertEquals(20, (float) $venda->final_total);

        $contact = Contact::where('cpf_cnpj', '12345678900')->firstOrFail();
        $this->assertEquals($venda->contact_id, $contact->id);

        $this->assertDatabaseHas('transaction_sell_lines', [
            'transaction_id' => $venda->id,
            'product_id' => $product->id,
            'variation_id' => $variation->id,
            'quantity' => 2,
        ]);

        $this->assertDatabaseHas('transaction_payments', [
            'transaction_id' => $venda->id,
            'amount' => 20,
        ]);
    }

    public function test_tracking_code_can_be_saved_for_an_order()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_ecommerce',
            'password' => 'secret123',
        ]);

        $pedido = PedidoEcommerce::create([
            'business_id' => $business->id,
            'status' => 1,
            'valor_total' => '10',
            'valor_frete' => '0',
            'valor_desconto' => '0',
            'tipo_frete' => 'PAC',
            'observacao' => '',
            'rand_pedido' => 'rp3',
            'link_boleto' => '',
            'qr_code_base64' => '',
            'qr_code' => '',
            'token' => 'pedido-token-3',
        ]);

        $this->actingAs($admin)
            ->post('/pedidosEcommerce/salvarCodigo', [
                'id' => $pedido->id,
                'codigo' => 'BR123456789',
            ])
            ->assertOk()
            ->assertSee('ok');

        $this->assertDatabaseHas('pedido_ecommerces', [
            'id' => $pedido->id,
            'codigo_rastreio' => 'BR123456789',
        ]);
    }
}
