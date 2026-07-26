<?php

namespace Tests\Concerns;

use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use App\Models\TaxRate;
use App\Models\Transaction;
use App\Models\Unit;
use App\Utils\ProductUtil;

trait CreatesStockedProduct
{
    /**
     * Creates a product with stock enabled, a single variation and an
     * initial available quantity at the given location.
     *
     * @return array{0: Product, 1: \App\Models\Variation}
     */
    protected function createStockedProduct($business, $admin, $location, float $initialQty = 50)
    {
        $unit = Unit::create([
            'business_id' => $business->id,
            'actual_name' => 'Unidade',
            'short_name' => 'Un',
            'allow_decimal' => 0,
            'created_by' => $admin->id,
        ]);

        $category = Category::create([
            'business_id' => $business->id,
            'name' => 'Categoria Teste',
            'image' => '',
            'parent_id' => 0,
            'created_by' => $admin->id,
        ]);

        $brand = Brands::create([
            'business_id' => $business->id,
            'name' => 'Marca Teste',
            'created_by' => $admin->id,
        ]);

        $tax = TaxRate::create([
            'business_id' => $business->id,
            'name' => 'ICMS 18%',
            'amount' => 18,
            'created_by' => $admin->id,
        ]);

        $product = Product::create([
            'business_id' => $business->id,
            'name' => 'Produto Estoque Teste',
            'type' => 'single',
            'unit_id' => $unit->id,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'tax' => $tax->id,
            'tax_type' => 'exclusive',
            'enable_stock' => 1,
            'sku' => 'PROD-STOCK-' . uniqid(),
            'barcode_type' => 'C128',
            'created_by' => $admin->id,
        ]);
        $product->product_locations()->sync([$location->id]);

        $productUtil = app(ProductUtil::class);
        $productUtil->createSingleProductVariation($product->id, $product->sku, '10', '10', '20', '15', '15');

        $variation = $product->variations()->first();

        if ($initialQty > 0) {
            // Seed stock via a real opening_stock transaction + purchase line
            // (not just VariationLocationDetails) because TransactionUtil::
            // mapPurchaseSell() - called by stock adjustments/transfers/sells -
            // requires a matching received purchase_lines row to consume
            // from; without it, the whole operation is rolled back with a
            // "PurchaseSellMismatch" error.
            $openingStock = Transaction::create([
                'type' => 'opening_stock',
                'opening_stock_product_id' => $product->id,
                'status' => 'received',
                'business_id' => $business->id,
                'transaction_date' => now(),
                'total_before_tax' => $initialQty * 10,
                'location_id' => $location->id,
                'final_total' => $initialQty * 10,
                'payment_status' => 'paid',
                'created_by' => $admin->id,
            ]);

            $openingStock->purchase_lines()->create([
                'product_id' => $product->id,
                'variation_id' => $variation->id,
                'quantity' => $initialQty,
                'purchase_price' => 10,
                'purchase_price_inc_tax' => 10,
                'pp_without_discount' => 10,
            ]);

            $productUtil->updateProductQuantity($location->id, $product->id, $variation->id, $initialQty, 0, null, false);
        }

        return [$product->fresh(), $variation->fresh()];
    }
}
