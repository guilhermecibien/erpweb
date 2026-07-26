<?php

namespace Tests\Concerns;

use App\Models\User;
use App\Utils\BusinessUtil;

trait CreatesBusiness
{
    /**
     * Creates a business with its owner/admin user, mirroring what
     * BusinessController@postRegister does for a real registration.
     *
     * @return array{0: \App\Models\Business, 1: \App\Models\User}
     */
    protected function createBusinessWithAdmin(array $userOverrides = [], array $businessOverrides = []): array
    {
        $businessUtil = app(BusinessUtil::class);

        $username = $userOverrides['username'] ?? 'admin' . uniqid();

        $user = User::create_user(array_merge([
            'surname' => '',
            'first_name' => 'Admin',
            'last_name' => 'Teste',
            'username' => $username,
            'email' => $username . '@example.com',
            'password' => 'password',
            'language' => 'pt',
        ], $userOverrides));

        $business = $businessUtil->createNewBusiness(array_merge([
            'name' => 'Empresa Teste',
            'currency_id' => 1,
            'owner_id' => $user->id,
            'start_date' => date('Y-m-d'),
            'enabled_modules' => ['purchases', 'add_sale', 'pos_sale', 'stock_transfers', 'stock_adjustment', 'expenses'],
        ], $businessOverrides));

        $business->date_format = 'd/m/Y';
        $business->start_date = date('Y-m-d');
        $business->save();

        $user->business_id = $business->id;
        $user->save();

        $businessUtil->newBusinessDefaultResources($business->id, $user->id);

        $businessUtil->addLocation($business->id, [
            'name' => 'Matriz',
            'landmark' => 'Rua Teste, 1',
            'city' => 'São Paulo',
            'state' => 'SP',
            'zip_code' => '01000-000',
            'country' => 'Brasil',
        ]);

        return [$business->fresh(), $user->fresh()];
    }

    /**
     * Creates an approved, currently-active Superadmin subscription for the
     * business. Several controllers (stock adjustments/transfers, business
     * locations, product creation form, ...) call
     * ModuleUtil::isSubscribed()/isQuotaAvailable() directly - regardless of
     * CheckPayment's administrator bypass - and redirect instead of running
     * when no active subscription exists.
     */
    protected function createActiveSubscription($business, $admin, array $packageOverrides = [])
    {
        $package = \Modules\Superadmin\Entities\Package::create(array_merge([
            'name' => 'Pacote Teste',
            'description' => 'Pacote de teste',
            'location_count' => 0,
            'user_count' => 0,
            'product_count' => 0,
            'invoice_count' => 0,
            'interval' => 'years',
            'interval_count' => 1,
            'trial_days' => 0,
            'price' => 0,
            'created_by' => $admin->id,
            'is_active' => 1,
            'is_visible' => 1,
            'enabled_modules' => json_encode([]),
        ], $packageOverrides));

        return \Modules\Superadmin\Entities\Subscription::create([
            'business_id' => $business->id,
            'package_id' => $package->id,
            'start_date' => now()->subDay()->toDateString(),
            'end_date' => now()->addYear()->toDateString(),
            'package_price' => $package->price,
            'package_details' => $package->toArray(),
            'created_id' => $admin->id,
            'status' => 'approved',
            'qr_code_base64' => '',
            'qr_code' => '',
            'forma_pagamento' => 'pix',
            'status_mp' => '',
        ]);
    }
}
