<div class="pos-tab-content">
     <div class="row">
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_custom_payments'):</h4>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f1 = ['name' => 'custom_payment_1_label', 'value' => __('lang_v1.custom_payment_1')];
                @endphp
                <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                @php
                $__f2 = ['name' => 'custom_labels[payments][custom_pay_1]', 'value' => !empty($custom_labels['payments']['custom_pay_1']) ? $custom_labels['payments']['custom_pay_1'] : null, 'options' => ['class' => 'form-control', 'id' => 'custom_payment_1']];
                @endphp
                <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f3 = ['name' => 'custom_payment_2_label', 'value' => __('lang_v1.custom_payment_2')];
                @endphp
                <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                @php
                $__f4 = ['name' => 'custom_labels[payments][custom_pay_2]', 'value' => !empty($custom_labels['payments']['custom_pay_2']) ? $custom_labels['payments']['custom_pay_2'] : null, 'options' => ['class' => 'form-control', 'id' => 'custom_payment_2']];
                @endphp
                <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f5 = ['name' => 'custom_payment_3_label', 'value' => __('lang_v1.custom_payment_3')];
                @endphp
                <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                @php
                $__f6 = ['name' => 'custom_labels[payments][custom_pay_3]', 'value' => !empty($custom_labels['payments']['custom_pay_3']) ? $custom_labels['payments']['custom_pay_3'] : null, 'options' => ['class' => 'form-control', 'id' => 'custom_payment_3']];
                @endphp
                <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_contact_custom_fields'):</h4>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f7 = ['name' => 'contact_custom_field_1_label', 'value' => __('lang_v1.contact_custom_field1')];
                @endphp
                <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
                @php
                $__f8 = ['name' => 'custom_labels[contact][custom_field_1]', 'value' => !empty($custom_labels['contact']['custom_field_1']) ? $custom_labels['contact']['custom_field_1'] : null, 'options' => ['class' => 'form-control', 'id' => 'contact_custom_field_1_label']];
                @endphp
                <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f9 = ['name' => 'contact_custom_field_2_label', 'value' => __('lang_v1.contact_custom_field2')];
                @endphp
                <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
                @php
                $__f10 = ['name' => 'custom_labels[contact][custom_field_2]', 'value' => !empty($custom_labels['contact']['custom_field_2']) ? $custom_labels['contact']['custom_field_2'] : null, 'options' => ['class' => 'form-control', 'id' => 'contact_custom_field_2_label']];
                @endphp
                <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f11 = ['name' => 'contact_custom_field_3_label', 'value' => __('lang_v1.contact_custom_field3')];
                @endphp
                <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
                @php
                $__f12 = ['name' => 'custom_labels[contact][custom_field_3]', 'value' => !empty($custom_labels['contact']['custom_field_3']) ? $custom_labels['contact']['custom_field_3'] : null, 'options' => ['class' => 'form-control', 'id' => 'contact_custom_field_3_label']];
                @endphp
                <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f13 = ['name' => 'contact_custom_field_4_label', 'value' => __('lang_v1.contact_custom_field4')];
                @endphp
                <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
                @php
                $__f14 = ['name' => 'custom_labels[contact][custom_field_4]', 'value' => !empty($custom_labels['contact']['custom_field_4']) ? $custom_labels['contact']['custom_field_4'] : null, 'options' => ['class' => 'form-control', 'id' => 'contact_custom_field_4_label']];
                @endphp
                <x-form.input type="text" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_product_custom_fields'):</h4>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f15 = ['name' => 'product_custom_field_1_label', 'value' => __('lang_v1.product_custom_field1')];
                @endphp
                <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
                @php
                $__f16 = ['name' => 'custom_labels[product][custom_field_1]', 'value' => !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : null, 'options' => ['class' => 'form-control', 'id' => 'product_custom_field_1_label']];
                @endphp
                <x-form.input type="text" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f17 = ['name' => 'product_custom_field_2_label', 'value' => __('lang_v1.product_custom_field2')];
                @endphp
                <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
                @php
                $__f18 = ['name' => 'custom_labels[product][custom_field_2]', 'value' => !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : null, 'options' => ['class' => 'form-control', 'id' => 'product_custom_field_2_label']];
                @endphp
                <x-form.input type="text" :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f19 = ['name' => 'product_custom_field_3_label', 'value' => __('lang_v1.product_custom_field3')];
                @endphp
                <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
                @php
                $__f20 = ['name' => 'custom_labels[product][custom_field_3]', 'value' => !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : null, 'options' => ['class' => 'form-control', 'id' => 'product_custom_field_3_label']];
                @endphp
                <x-form.input type="text" :name="$__f20['name']" :value="$__f20['value']" :options="$__f20['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f21 = ['name' => 'product_custom_field_4_label', 'value' => __('lang_v1.product_custom_field4')];
                @endphp
                <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
                @php
                $__f22 = ['name' => 'custom_labels[product][custom_field_4]', 'value' => !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : null, 'options' => ['class' => 'form-control', 'id' => 'product_custom_field_4_label']];
                @endphp
                <x-form.input type="text" :name="$__f22['name']" :value="$__f22['value']" :options="$__f22['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_location_custom_fields'):</h4>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f23 = ['name' => 'location_custom_field_1_label', 'value' => __('lang_v1.location_custom_field1')];
                @endphp
                <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
                @php
                $__f24 = ['name' => 'custom_labels[location][custom_field_1]', 'value' => !empty($custom_labels['location']['custom_field_1']) ? $custom_labels['location']['custom_field_1'] : null, 'options' => ['class' => 'form-control', 'id' => 'location_custom_field_1_label']];
                @endphp
                <x-form.input type="text" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f25 = ['name' => 'location_custom_field_2_label', 'value' => __('lang_v1.location_custom_field2')];
                @endphp
                <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
                @php
                $__f26 = ['name' => 'custom_labels[location][custom_field_2]', 'value' => !empty($custom_labels['location']['custom_field_2']) ? $custom_labels['location']['custom_field_2'] : null, 'options' => ['class' => 'form-control', 'id' => 'location_custom_field_2_label']];
                @endphp
                <x-form.input type="text" :name="$__f26['name']" :value="$__f26['value']" :options="$__f26['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f27 = ['name' => 'location_custom_field_3_label', 'value' => __('lang_v1.location_custom_field3')];
                @endphp
                <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
                @php
                $__f28 = ['name' => 'custom_labels[location][custom_field_3]', 'value' => !empty($custom_labels['location']['custom_field_3']) ? $custom_labels['location']['custom_field_3'] : null, 'options' => ['class' => 'form-control', 'id' => 'location_custom_field_3_label']];
                @endphp
                <x-form.input type="text" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f29 = ['name' => 'location_custom_field_4_label', 'value' => __('lang_v1.location_custom_field4')];
                @endphp
                <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
                @php
                $__f30 = ['name' => 'custom_labels[location][custom_field_4]', 'value' => !empty($custom_labels['location']['custom_field_4']) ? $custom_labels['location']['custom_field_4'] : null, 'options' => ['class' => 'form-control', 'id' => 'location_custom_field_4_label']];
                @endphp
                <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_user_custom_fields'):</h4>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f31 = ['name' => 'user_custom_field_1_label', 'value' => __('lang_v1.user_custom_field1')];
                @endphp
                <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
                @php
                $__f32 = ['name' => 'custom_labels[user][custom_field_1]', 'value' => !empty($custom_labels['user']['custom_field_1']) ? $custom_labels['user']['custom_field_1'] : null, 'options' => ['class' => 'form-control', 'id' => 'user_custom_field_1_label']];
                @endphp
                <x-form.input type="text" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f33 = ['name' => 'user_custom_field_2_label', 'value' => __('lang_v1.user_custom_field2')];
                @endphp
                <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
                @php
                $__f34 = ['name' => 'custom_labels[user][custom_field_2]', 'value' => !empty($custom_labels['user']['custom_field_2']) ? $custom_labels['user']['custom_field_2'] : null, 'options' => ['class' => 'form-control', 'id' => 'user_custom_field_2_label']];
                @endphp
                <x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f35 = ['name' => 'user_custom_field_3_label', 'value' => __('lang_v1.user_custom_field3')];
                @endphp
                <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
                @php
                $__f36 = ['name' => 'custom_labels[user][custom_field_3]', 'value' => !empty($custom_labels['user']['custom_field_3']) ? $custom_labels['user']['custom_field_3'] : null, 'options' => ['class' => 'form-control', 'id' => 'user_custom_field_3_label']];
                @endphp
                <x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f37 = ['name' => 'user_custom_field_4_label', 'value' => __('lang_v1.user_custom_field4')];
                @endphp
                <x-form.label :name="$__f37['name']" :value="$__f37['value']" />
                @php
                $__f38 = ['name' => 'custom_labels[user][custom_field_4]', 'value' => !empty($custom_labels['user']['custom_field_4']) ? $custom_labels['user']['custom_field_4'] : null, 'options' => ['class' => 'form-control', 'id' => 'user_custom_field_4_label']];
                @endphp
                <x-form.input type="text" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_purchase_custom_fields'):</h4>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f39 = ['name' => 'purchase_custom_field_1_label', 'value' => __('lang_v1.product_custom_field1')];
                @endphp
                <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
                @php
                $__f40 = ['name' => 'custom_labels[purchase][custom_field_1]', 'value' => !empty($custom_labels['purchase']['custom_field_1']) ? $custom_labels['purchase']['custom_field_1'] : null, 'options' => ['class' => 'form-control', 'id' => 'purchase_custom_field_1_label']];
                @endphp
                <x-form.input type="text" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f41 = ['name' => 'purchase_custom_field_2_label', 'value' => __('lang_v1.product_custom_field2')];
                @endphp
                <x-form.label :name="$__f41['name']" :value="$__f41['value']" />
                @php
                $__f42 = ['name' => 'custom_labels[purchase][custom_field_2]', 'value' => !empty($custom_labels['purchase']['custom_field_2']) ? $custom_labels['purchase']['custom_field_2'] : null, 'options' => ['class' => 'form-control', 'id' => 'purchase_custom_field_2_label']];
                @endphp
                <x-form.input type="text" :name="$__f42['name']" :value="$__f42['value']" :options="$__f42['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f43 = ['name' => 'purchase_custom_field_3_label', 'value' => __('lang_v1.product_custom_field3')];
                @endphp
                <x-form.label :name="$__f43['name']" :value="$__f43['value']" />
                @php
                $__f44 = ['name' => 'custom_labels[purchase][custom_field_3]', 'value' => !empty($custom_labels['purchase']['custom_field_3']) ? $custom_labels['purchase']['custom_field_3'] : null, 'options' => ['class' => 'form-control', 'id' => 'purchase_custom_field_3_label']];
                @endphp
                <x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f45 = ['name' => 'purchase_custom_field_4_label', 'value' => __('lang_v1.product_custom_field4')];
                @endphp
                <x-form.label :name="$__f45['name']" :value="$__f45['value']" />
                @php
                $__f46 = ['name' => 'custom_labels[purchase][custom_field_4]', 'value' => !empty($custom_labels['purchase']['custom_field_4']) ? $custom_labels['purchase']['custom_field_4'] : null, 'options' => ['class' => 'form-control', 'id' => 'purchase_custom_field_4_label']];
                @endphp
                <x-form.input type="text" :name="$__f46['name']" :value="$__f46['value']" :options="$__f46['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_sell_custom_fields'):</h4>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f47 = ['name' => 'sell_custom_field_1_label', 'value' => __('lang_v1.product_custom_field1')];
                @endphp
                <x-form.label :name="$__f47['name']" :value="$__f47['value']" />
                @php
                $__f48 = ['name' => 'custom_labels[sell][custom_field_1]', 'value' => !empty($custom_labels['sell']['custom_field_1']) ? $custom_labels['sell']['custom_field_1'] : null, 'options' => ['class' => 'form-control', 'id' => 'sell_custom_field_1_label']];
                @endphp
                <x-form.input type="text" :name="$__f48['name']" :value="$__f48['value']" :options="$__f48['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f49 = ['name' => 'sell_custom_field_2_label', 'value' => __('lang_v1.product_custom_field2')];
                @endphp
                <x-form.label :name="$__f49['name']" :value="$__f49['value']" />
                @php
                $__f50 = ['name' => 'custom_labels[sell][custom_field_2]', 'value' => !empty($custom_labels['sell']['custom_field_2']) ? $custom_labels['sell']['custom_field_2'] : null, 'options' => ['class' => 'form-control', 'id' => 'sell_custom_field_2_label']];
                @endphp
                <x-form.input type="text" :name="$__f50['name']" :value="$__f50['value']" :options="$__f50['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f51 = ['name' => 'sell_custom_field_3_label', 'value' => __('lang_v1.product_custom_field3')];
                @endphp
                <x-form.label :name="$__f51['name']" :value="$__f51['value']" />
                @php
                $__f52 = ['name' => 'custom_labels[sell][custom_field_3]', 'value' => !empty($custom_labels['sell']['custom_field_3']) ? $custom_labels['sell']['custom_field_3'] : null, 'options' => ['class' => 'form-control', 'id' => 'sell_custom_field_3_label']];
                @endphp
                <x-form.input type="text" :name="$__f52['name']" :value="$__f52['value']" :options="$__f52['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f53 = ['name' => 'sell_custom_field_4_label', 'value' => __('lang_v1.product_custom_field4')];
                @endphp
                <x-form.label :name="$__f53['name']" :value="$__f53['value']" />
                @php
                $__f54 = ['name' => 'custom_labels[sell][custom_field_4]', 'value' => !empty($custom_labels['sell']['custom_field_4']) ? $custom_labels['sell']['custom_field_4'] : null, 'options' => ['class' => 'form-control', 'id' => 'sell_custom_field_4_label']];
                @endphp
                <x-form.input type="text" :name="$__f54['name']" :value="$__f54['value']" :options="$__f54['options']" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4>@lang('lang_v1.labels_for_types_of_service_custom_fields'):</h4>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f55 = ['name' => 'types_of_service_custom_field_1_label', 'value' => __('lang_v1.service_custom_field_1')];
                @endphp
                <x-form.label :name="$__f55['name']" :value="$__f55['value']" />
                @php
                $__f56 = ['name' => 'custom_labels[types_of_service][custom_field_1]', 'value' => !empty($custom_labels['types_of_service']['custom_field_1']) ? $custom_labels['types_of_service']['custom_field_1'] : null, 'options' => ['class' => 'form-control', 'id' => 'types_of_service_custom_field_1_label']];
                @endphp
                <x-form.input type="text" :name="$__f56['name']" :value="$__f56['value']" :options="$__f56['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f57 = ['name' => 'types_of_service_custom_field_2_label', 'value' => __('lang_v1.service_custom_field_2')];
                @endphp
                <x-form.label :name="$__f57['name']" :value="$__f57['value']" />
                @php
                $__f58 = ['name' => 'custom_labels[types_of_service][custom_field_2]', 'value' => !empty($custom_labels['types_of_service']['custom_field_2']) ? $custom_labels['types_of_service']['custom_field_2'] : null, 'options' => ['class' => 'form-control', 'id' => 'types_of_service_custom_field_2_label']];
                @endphp
                <x-form.input type="text" :name="$__f58['name']" :value="$__f58['value']" :options="$__f58['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f59 = ['name' => 'types_of_service_custom_field_3_label', 'value' => __('lang_v1.service_custom_field_3')];
                @endphp
                <x-form.label :name="$__f59['name']" :value="$__f59['value']" />
                @php
                $__f60 = ['name' => 'custom_labels[types_of_service][custom_field_3]', 'value' => !empty($custom_labels['types_of_service']['custom_field_3']) ? $custom_labels['types_of_service']['custom_field_3'] : null, 'options' => ['class' => 'form-control', 'id' => 'types_of_service_custom_field_3_label']];
                @endphp
                <x-form.input type="text" :name="$__f60['name']" :value="$__f60['value']" :options="$__f60['options']" />
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                @php
                $__f61 = ['name' => 'types_of_service_custom_field_4_label', 'value' => __('lang_v1.service_custom_field_4')];
                @endphp
                <x-form.label :name="$__f61['name']" :value="$__f61['value']" />
                @php
                $__f62 = ['name' => 'custom_labels[types_of_service][custom_field_4]', 'value' => !empty($custom_labels['types_of_service']['custom_field_4']) ? $custom_labels['types_of_service']['custom_field_4'] : null, 'options' => ['class' => 'form-control', 'id' => 'types_of_service_custom_field_4_label']];
                @endphp
                <x-form.input type="text" :name="$__f62['name']" :value="$__f62['value']" :options="$__f62['options']" />
            </div>
        </div>
    </div>
</div>