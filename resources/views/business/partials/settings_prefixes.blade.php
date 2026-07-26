<div class="pos-tab-content">
     <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_prefix = '';
                    if(!empty($business->ref_no_prefixes['purchase'])){
                        $purchase_prefix = $business->ref_no_prefixes['purchase'];
                    }
                @endphp
                @php
                $__f1 = ['name' => 'ref_no_prefixes[purchase]', 'value' => __('lang_v1.purchase_order') . ':'];
                @endphp
                <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                @php
                $__f2 = ['name' => 'ref_no_prefixes[purchase]', 'value' => $purchase_prefix, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_return = '';
                    if(!empty($business->ref_no_prefixes['purchase_return'])){
                        $purchase_return = $business->ref_no_prefixes['purchase_return'];
                    }
                @endphp
                @php
                $__f3 = ['name' => 'ref_no_prefixes[purchase_return]', 'value' => __('lang_v1.purchase_return') . ':'];
                @endphp
                <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                @php
                $__f4 = ['name' => 'ref_no_prefixes[purchase_return]', 'value' => $purchase_return, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $stock_transfer_prefix = '';
                    if(!empty($business->ref_no_prefixes['stock_transfer'])){
                        $stock_transfer_prefix = $business->ref_no_prefixes['stock_transfer'];
                    }
                @endphp
                @php
                $__f5 = ['name' => 'ref_no_prefixes[stock_transfer]', 'value' => __('lang_v1.stock_transfer') . ':'];
                @endphp
                <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                @php
                $__f6 = ['name' => 'ref_no_prefixes[stock_transfer]', 'value' => $stock_transfer_prefix, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $stock_adjustment_prefix = '';
                    if(!empty($business->ref_no_prefixes['stock_adjustment'])){
                        $stock_adjustment_prefix = $business->ref_no_prefixes['stock_adjustment'];
                    }
                @endphp
                @php
                $__f7 = ['name' => 'ref_no_prefixes[stock_adjustment]', 'value' => __('stock_adjustment.stock_adjustment') . ':'];
                @endphp
                <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                @php
                $__f8 = ['name' => 'ref_no_prefixes[stock_adjustment]', 'value' => $stock_adjustment_prefix, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $sell_return_prefix = '';
                    if(!empty($business->ref_no_prefixes['sell_return'])){
                        $sell_return_prefix = $business->ref_no_prefixes['sell_return'];
                    }
                @endphp
                @php
                $__f9 = ['name' => 'ref_no_prefixes[sell_return]', 'value' => __('lang_v1.sell_return') . ':'];
                @endphp
                <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
                @php
                $__f10 = ['name' => 'ref_no_prefixes[sell_return]', 'value' => $sell_return_prefix, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $expenses_prefix = '';
                    if(!empty($business->ref_no_prefixes['expense'])){
                        $expenses_prefix = $business->ref_no_prefixes['expense'];
                    }
                @endphp
                @php
                $__f11 = ['name' => 'ref_no_prefixes[expense]', 'value' => __('expense.expenses') . ':'];
                @endphp
                <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
                @php
                $__f12 = ['name' => 'ref_no_prefixes[expense]', 'value' => $expenses_prefix, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $contacts_prefix = '';
                    if(!empty($business->ref_no_prefixes['contacts'])){
                        $contacts_prefix = $business->ref_no_prefixes['contacts'];
                    }
                @endphp
                @php
                $__f13 = ['name' => 'ref_no_prefixes[contacts]', 'value' => __('contact.contacts') . ':'];
                @endphp
                <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
                @php
                $__f14 = ['name' => 'ref_no_prefixes[contacts]', 'value' => $contacts_prefix, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $purchase_payment = '';
                    if(!empty($business->ref_no_prefixes['purchase_payment'])){
                        $purchase_payment = $business->ref_no_prefixes['purchase_payment'];
                    }
                @endphp
                @php
                $__f15 = ['name' => 'ref_no_prefixes[purchase_payment]', 'value' => __('lang_v1.purchase_payment') . ':'];
                @endphp
                <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
                @php
                $__f16 = ['name' => 'ref_no_prefixes[purchase_payment]', 'value' => $purchase_payment, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $sell_payment = '';
                    if(!empty($business->ref_no_prefixes['sell_payment'])){
                        $sell_payment = $business->ref_no_prefixes['sell_payment'];
                    }
                @endphp
                @php
                $__f17 = ['name' => 'ref_no_prefixes[sell_payment]', 'value' => __('lang_v1.sell_payment') . ':'];
                @endphp
                <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
                @php
                $__f18 = ['name' => 'ref_no_prefixes[sell_payment]', 'value' => $sell_payment, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $expense_payment = '';
                    if(!empty($business->ref_no_prefixes['expense_payment'])){
                        $expense_payment = $business->ref_no_prefixes['expense_payment'];
                    }
                @endphp
                @php
                $__f19 = ['name' => 'ref_no_prefixes[expense_payment]', 'value' => __('lang_v1.expense_payment') . ':'];
                @endphp
                <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
                @php
                $__f20 = ['name' => 'ref_no_prefixes[expense_payment]', 'value' => $expense_payment, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $business_location_prefix = '';
                    if(!empty($business->ref_no_prefixes['business_location'])){
                        $business_location_prefix = $business->ref_no_prefixes['business_location'];
                    }
                @endphp
                @php
                $__f21 = ['name' => 'ref_no_prefixes[business_location]', 'value' => __('business.business_location') . ':'];
                @endphp
                <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
                @php
                $__f22 = ['name' => 'ref_no_prefixes[business_location]', 'value' => $business_location_prefix, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $username_prefix = !empty($business->ref_no_prefixes['username']) ? $business->ref_no_prefixes['username'] : '';
                @endphp
                @php
                $__f23 = ['name' => 'ref_no_prefixes[username]', 'value' => __('business.username') . ':'];
                @endphp
                <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
                @php
                $__f24 = ['name' => 'ref_no_prefixes[username]', 'value' => $username_prefix, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                    $subscription_prefix = !empty($business->ref_no_prefixes['subscription']) ? $business->ref_no_prefixes['subscription'] : '';
                @endphp
                @php
                $__f25 = ['name' => 'ref_no_prefixes[subscription]', 'value' => __('lang_v1.subscription_no') . ':'];
                @endphp
                <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
                @php
                $__f26 = ['name' => 'ref_no_prefixes[subscription]', 'value' => $subscription_prefix, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
            </div>
        </div>
    </div>
</div>