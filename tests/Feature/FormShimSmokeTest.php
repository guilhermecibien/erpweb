<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Concerns\CreatesBusiness;

class FormShimSmokeTest extends TestCase
{
    use CreatesBusiness;

    public function test_product_create_page_renders_with_form_shim()
    {
        [$business, $admin] = $this->createBusinessWithAdmin();
        $this->createActiveSubscription($business, $admin);

        $response = $this->actingAs($admin)->get('/products/create');

        $response->assertOk();
        $response->assertSee('<form', false);
    }

    public function test_contact_create_page_renders_with_form_shim()
    {
        [$business, $admin] = $this->createBusinessWithAdmin();
        $this->createActiveSubscription($business, $admin);

        $response = $this->actingAs($admin)->get('/contacts/create');

        $response->assertOk();
        $response->assertSee('<form', false);
    }
}
