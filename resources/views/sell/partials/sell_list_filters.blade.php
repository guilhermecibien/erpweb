@if(empty($only) || in_array('sell_list_filter_location_id', $only))
<div class="col-md-3">
    <div class="form-group">
        @php
        $__f1 = ['name' => 'sell_list_filter_location_id', 'value' => __('purchase.business_location') . ':'];
        @endphp
        <x-form.label :name="$__f1['name']" :value="$__f1['value']" />

        @php
        $__f2 = ['name' => 'sell_list_filter_location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]];
        @endphp
        <x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
    </div>
</div>
@endif
@if(empty($only) || in_array('sell_list_filter_customer_id', $only))
<div class="col-md-3">
    <div class="form-group">
        @php
        $__f3 = ['name' => 'sell_list_filter_customer_id', 'value' => __('contact.customer') . ':'];
        @endphp
        <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
        @php
        $__f4 = ['name' => 'sell_list_filter_customer_id', 'list' => $customers, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]];
        @endphp
        <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
    </div>
</div>
@endif
@if(empty($only) || in_array('sell_list_filter_payment_status', $only))
<div class="col-md-3">
    <div class="form-group">
        @php
        $__f5 = ['name' => 'sell_list_filter_payment_status', 'value' => __('purchase.payment_status') . ':'];
        @endphp
        <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
        @php
        $__f6 = ['name' => 'sell_list_filter_payment_status', 'list' => ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]];
        @endphp
        <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
    </div>
</div>
@endif
@if(empty($only) || in_array('sell_list_filter_date_range', $only))
<div class="col-md-3">
    <div class="form-group">
        @php
        $__f7 = ['name' => 'sell_list_filter_date_range', 'value' => __('report.date_range') . ':'];
        @endphp
        <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
        @php
        $__f8 = ['name' => 'sell_list_filter_date_range', 'value' => null, 'options' => ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']];
        @endphp
        <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
    </div>
</div>
@endif
@if((empty($only) || in_array('created_by', $only)) && !empty($sales_representative))
<div class="col-md-3">
    <div class="form-group">
        @php
        $__f9 = ['name' => 'created_by', 'value' => __('report.user') . ':'];
        @endphp
        <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
        @php
        $__f10 = ['name' => 'created_by', 'list' => $sales_representative, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%']];
        @endphp
        <x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" />
    </div>
</div>
@endif
@if(empty($only) || in_array('sales_cmsn_agnt', $only))
@if(!empty($is_cmsn_agent_enabled))
    <div class="col-md-3">
        <div class="form-group">
            @php
            $__f11 = ['name' => 'sales_cmsn_agnt', 'value' => __('lang_v1.sales_commission_agent') . ':'];
            @endphp
            <x-form.label :name="$__f11['name']" :value="$__f11['value']" />
            @php
            $__f12 = ['name' => 'sales_cmsn_agnt', 'list' => $commission_agents, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%']];
            @endphp
            <x-form.select :name="$__f12['name']" :list="$__f12['list']" :selected="$__f12['selected']" :options="$__f12['options']" />
        </div>
    </div>
@endif
@endif
@if(empty($only) || in_array('service_staffs', $only))
@if(!empty($service_staffs))
    <div class="col-md-3">
        <div class="form-group">
            @php
            $__f13 = ['name' => 'service_staffs', 'value' => __('restaurant.service_staff') . ':'];
            @endphp
            <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
            @php
            $__f14 = ['name' => 'service_staffs', 'list' => $service_staffs, 'selected' => null, 'options' => ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]];
            @endphp
            <x-form.select :name="$__f14['name']" :list="$__f14['list']" :selected="$__f14['selected']" :options="$__f14['options']" />
        </div>
    </div>
@endif
@endif
@if(empty($only) || in_array('only_subscriptions', $only))
<div class="col-md-3">
    <div class="form-group">
        <div class="checkbox">
            <label>
                <br>
              @php
              $__f15 = ['name' => 'only_subscriptions', 'value' => 1, 'checked' => false, 'options' => [ 'class' => 'input-icheck', 'id' => 'only_subscriptions']];
              @endphp
              <x-form.checkbox :name="$__f15['name']" :value="$__f15['value']" :checked="$__f15['checked']" :options="$__f15['options']" /> {{ __('lang_v1.subscriptions') }}
            </label>
        </div>
    </div>
</div>

@endif

<div class="col-md-3">
    <div class="form-group">
        <div class="checkbox">
            <label>
                <br>
              @php
              $__f16 = ['name' => 'ecommerce', 'value' => 1, 'checked' => false, 'options' => [ 'class' => 'input-icheck', 'id' => 'ecommerce']];
              @endphp
              <x-form.checkbox :name="$__f16['name']" :value="$__f16['value']" :checked="$__f16['checked']" :options="$__f16['options']" /> Ecommerce
            </label>
        </div>
    </div>
</div>