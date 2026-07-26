<?php

namespace Tests\Feature\Products;

use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use App\Models\TaxRate;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBusiness;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    use CreatesBusiness;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        // CheckPayment middleware redirects businesses without an active
        // subscription to /payment. Bypass it the same way production does
        // for administrator accounts, since subscriptions are out of scope
        // for these controller tests.
        config(['constants.administrator_usernames' => implode(',', [
            'admin_product_index',
            'no_perm_user',
            'admin_product_create',
            'admin_product_store_denied',
            'no_create_user',
            'admin_product_update',
            'admin_product_delete_denied',
            'no_delete_user',
            'admin_product_destroy',
        ])]);
    }

    private function createUnit($business, $admin)
    {
        return Unit::create([
            'business_id' => $business->id,
            'actual_name' => 'Unidade',
            'short_name' => 'Un',
            'allow_decimal' => 0,
            'created_by' => $admin->id,
        ]);
    }

    private function createCategory($business, $admin)
    {
        return Category::create([
            'business_id' => $business->id,
            'name' => 'Categoria Teste',
            'image' => '',
            'parent_id' => 0,
            'created_by' => $admin->id,
        ]);
    }

    private function createBrand($business, $admin)
    {
        return Brands::create([
            'business_id' => $business->id,
            'name' => 'Marca Teste',
            'created_by' => $admin->id,
        ]);
    }

    private function createTaxRate($business, $admin)
    {
        return TaxRate::create([
            'business_id' => $business->id,
            'name' => 'ICMS 18%',
            'amount' => 18,
            'created_by' => $admin->id,
        ]);
    }

    private function minimalProductPayload($unit, $category, $brand, $tax)
    {
        return [
            'name' => 'Produto Teste',
            'type' => 'single',
            'unit_id' => $unit->id,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'tax' => $tax->id,
            'tax_type' => 'exclusive',
            'barcode_type' => 'C128',
            'sku' => '',
            'alert_quantity' => 0,
            'single_dpp' => '10',
            'single_dpp_inc_tax' => '10',
            'profit_percent' => '20',
            'single_dsp' => '12',
            'single_dsp_inc_tax' => '12',
        ];
    }

    public function test_index_requires_view_or_create_permission()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_product_index',
            'password' => 'secret123',
        ]);

        $viewer = User::create_user([
            'surname' => '',
            'first_name' => 'Sem',
            'last_name' => 'Permissao',
            'username' => 'no_perm_user',
            'email' => 'no_perm_user@example.com',
            'password' => 'secret123',
            'language' => 'pt',
        ]);
        $viewer->business_id = $business->id;
        $viewer->save();
        $viewer = $viewer->fresh();

        $this->actingAs($viewer)
            ->get('/products')
            ->assertForbidden();

        $this->actingAs($admin)
            ->get('/products')
            ->assertOk();
    }

    public function test_admin_can_create_a_single_product()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_product_create',
            'password' => 'secret123',
        ]);

        $unit = $this->createUnit($business, $admin);
        $category = $this->createCategory($business, $admin);
        $brand = $this->createBrand($business, $admin);
        $tax = $this->createTaxRate($business, $admin);

        $this->actingAs($admin)
            ->post('/products', $this->minimalProductPayload($unit, $category, $brand, $tax))
            ->assertRedirect('products');

        $this->assertDatabaseHas('products', [
            'business_id' => $business->id,
            'name' => 'Produto Teste',
            'type' => 'single',
            'unit_id' => $unit->id,
            'category_id' => $category->id,
        ]);

        $product = Product::where('business_id', $business->id)->where('name', 'Produto Teste')->firstOrFail();
        $this->assertTrue($product->product_variations()->exists());
    }

    public function test_user_without_create_permission_cannot_store_product()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_product_store_denied',
            'password' => 'secret123',
        ]);

        $unit = $this->createUnit($business, $admin);
        $category = $this->createCategory($business, $admin);
        $brand = $this->createBrand($business, $admin);
        $tax = $this->createTaxRate($business, $admin);

        $viewer = User::create_user([
            'surname' => '',
            'first_name' => 'Sem',
            'last_name' => 'Permissao',
            'username' => 'no_create_user',
            'email' => 'no_create_user@example.com',
            'password' => 'secret123',
            'language' => 'pt',
        ]);
        $viewer->business_id = $business->id;
        $viewer->save();
        $viewer = $viewer->fresh();

        $this->actingAs($viewer)
            ->post('/products', $this->minimalProductPayload($unit, $category, $brand, $tax))
            ->assertForbidden();

        $this->assertDatabaseMissing('products', [
            'business_id' => $business->id,
            'name' => 'Produto Teste',
        ]);
    }

    public function test_admin_can_update_a_product()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_product_update',
            'password' => 'secret123',
        ]);

        $unit = $this->createUnit($business, $admin);
        $category = $this->createCategory($business, $admin);
        $brand = $this->createBrand($business, $admin);
        $tax = $this->createTaxRate($business, $admin);

        $this->actingAs($admin)
            ->post('/products', $this->minimalProductPayload($unit, $category, $brand, $tax));

        $product = Product::where('business_id', $business->id)->firstOrFail();
        $variation = $product->product_variations()->first()->variations()->first();

        $payload = [
            'name' => 'Produto Atualizado',
            'unit_id' => $unit->id,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'tax' => $tax->id,
            'tax_type' => 'exclusive',
            'barcode_type' => 'C128',
            'sku' => $product->sku,
            'alert_quantity' => 0,
            'weight' => '0',
            'product_custom_field1' => '',
            'product_custom_field2' => '',
            'product_custom_field3' => '',
            'product_custom_field4' => '',
            'product_description' => '',
            'sub_unit_ids' => '',
            'perc_icms' => '0',
            'perc_pis' => '0',
            'perc_cofins' => '0',
            'perc_ipi' => '0',
            'cfop_interno' => '5101',
            'cfop_externo' => '6101',
            'cst_csosn' => '101',
            'cst_pis' => '49',
            'cst_cofins' => '49',
            'cst_ipi' => '99',
            'ncm' => '0',
            'cest' => '',
            'codigo_barras' => '',
            'codigo_anp' => '',
            'perc_glp' => '0',
            'perc_gnn' => '0',
            'perc_gni' => '0',
            'valor_partida' => '0',
            'unidade_tributavel' => '',
            'quantidade_tributavel' => '0',
            'tipo' => 'normal',
            'veicProd' => '',
            'tpOp' => '',
            'chassi' => '',
            'cCor' => '',
            'xCor' => '',
            'pot' => '0',
            'cilin' => '0',
            'pesoL' => '',
            'pesoB' => '',
            'nSerie' => '',
            'tpComb' => '',
            'nMotor' => '',
            'CMT' => '',
            'dist' => '',
            'anoMod' => '',
            'anoFab' => '',
            'tpPint' => '',
            'tpVeic' => '',
            'espVeic' => '',
            'VIN' => '',
            'condVeic' => '',
            'cMod' => '',
            'cCorDENATRAN' => '',
            'lota' => '',
            'tpRest' => '',
            'altura' => '0',
            'largura' => '0',
            'comprimento' => '0',
            'valor_ecommerce' => '0',
            'origem' => '0',
            'single_variation_id' => $variation->id,
            'single_dpp' => '11',
            'single_dpp_inc_tax' => '11',
            'profit_percent' => '20',
            'single_dsp' => '13',
            'single_dsp_inc_tax' => '13',
        ];

        $this->actingAs($admin)
            ->put('/products/' . $product->id, $payload)
            ->assertRedirect('products');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Produto Atualizado',
        ]);
    }

    public function test_user_without_delete_permission_cannot_destroy_product()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_product_delete_denied',
            'password' => 'secret123',
        ]);

        $unit = $this->createUnit($business, $admin);
        $category = $this->createCategory($business, $admin);
        $brand = $this->createBrand($business, $admin);
        $tax = $this->createTaxRate($business, $admin);

        $this->actingAs($admin)
            ->post('/products', $this->minimalProductPayload($unit, $category, $brand, $tax));
        $product = Product::where('business_id', $business->id)->firstOrFail();

        $viewer = User::create_user([
            'surname' => '',
            'first_name' => 'Sem',
            'last_name' => 'Permissao',
            'username' => 'no_delete_user',
            'email' => 'no_delete_user@example.com',
            'password' => 'secret123',
            'language' => 'pt',
        ]);
        $viewer->business_id = $business->id;
        $viewer->save();
        $viewer = $viewer->fresh();

        $this->actingAs($viewer)
            ->delete('/products/' . $product->id)
            ->assertForbidden();

        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_admin_can_destroy_a_product_without_transactions()
    {
        [$business, $admin] = $this->createBusinessWithAdmin([
            'username' => 'admin_product_destroy',
            'password' => 'secret123',
        ]);

        $unit = $this->createUnit($business, $admin);
        $category = $this->createCategory($business, $admin);
        $brand = $this->createBrand($business, $admin);
        $tax = $this->createTaxRate($business, $admin);

        $this->actingAs($admin)
            ->post('/products', $this->minimalProductPayload($unit, $category, $brand, $tax));
        $product = Product::where('business_id', $business->id)->firstOrFail();

        $response = $this->actingAs($admin)
            ->delete('/products/' . $product->id, [], ['X-Requested-With' => 'XMLHttpRequest']);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
