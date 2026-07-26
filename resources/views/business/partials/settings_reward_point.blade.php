<div class="pos-tab-content">
<div class="row well">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                @php
                $__f1 = ['name' => 'enable_rp', 'value' => 1, 'checked' => $business->enable_rp, 'options' => [ 'class' => 'input-icheck', 'id' => 'enable_rp']];
                @endphp
                <x-form.checkbox :name="$__f1['name']" :value="$__f1['value']" :checked="$__f1['checked']" :options="$__f1['options']" /> {{ __( 'lang_v1.enable_rp' ) }}
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            @php
            $__f2 = ['name' => 'rp_name', 'value' => __('lang_v1.rp_name') . ':'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            @php
            $__f3 = ['name' => 'rp_name', 'value' => $business->rp_name, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.rp_name')]];
            @endphp
            <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="col-sm-12">
        <h4>@lang('lang_v1.earning_points_setting'):</h4>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            @php
            $__f4 = ['name' => 'amount_for_unit_rp', 'value' => __('lang_v1.amount_for_unit_rp') . ':'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" /> @show_tooltip(__('lang_v1.amount_for_unit_rp_tooltip'))
            @php
            $__f5 = ['name' => 'amount_for_unit_rp', 'value' => number_format($business->amount_for_unit_rp, 2, ',', '.'), 'options' => ['class' => 'form-control input_number','placeholder' => __('lang_v1.amount_for_unit_rp')]];
            @endphp
            <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            @php
            $__f6 = ['name' => 'min_order_total_for_rp', 'value' => __('lang_v1.min_order_total_for_rp') . ':'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" /> @show_tooltip(__('lang_v1.min_order_total_for_rp_tooltip'))
            @php
            $__f7 = ['name' => 'min_order_total_for_rp', 'value' => number_format($business->min_order_total_for_rp, 2, ',', '.'), 'options' => ['class' => 'form-control input_number','placeholder' => __('lang_v1.min_order_total_for_rp')]];
            @endphp
            <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            @php
            $__f8 = ['name' => 'max_rp_per_order', 'value' => __('lang_v1.max_rp_per_order') . ':'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" /> @show_tooltip(__('lang_v1.max_rp_per_order_tooltip'))
            @php
            $__f9 = ['name' => 'max_rp_per_order', 'value' => $business->max_rp_per_order, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.max_rp_per_order')]];
            @endphp
            <x-form.input type="number" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
        </div>
    </div>
   </div>
   <div class="row well">
    <div class="col-sm-12">
        <h4>@lang('lang_v1.redeem_points_setting'):</h4>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            @php
            $__f10 = ['name' => 'redeem_amount_per_unit_rp', 'value' => __('lang_v1.redeem_amount_per_unit_rp') . ':'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" /> @show_tooltip(__('lang_v1.redeem_amount_per_unit_rp_tooltip'))
            @php
            $__f11 = ['name' => 'redeem_amount_per_unit_rp', 'value' => number_format($business->redeem_amount_per_unit_rp, 2, ',', '.'), 'options' => ['class' => 'form-control input_number','placeholder' => __('lang_v1.redeem_amount_per_unit_rp')]];
            @endphp
            <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            @php
            $__f12 = ['name' => 'min_order_total_for_redeem', 'value' => __('lang_v1.min_order_total_for_redeem') . ':'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" /> @show_tooltip(__('lang_v1.min_order_total_for_redeem_tooltip'))
            @php
            $__f13 = ['name' => 'min_order_total_for_redeem', 'value' => number_format($business->min_order_total_for_redeem, 2, ',', '.'), 'options' => ['class' => 'form-control input_number','placeholder' => __('lang_v1.min_order_total_for_redeem')]];
            @endphp
            <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            @php
            $__f14 = ['name' => 'min_redeem_point', 'value' => __('lang_v1.min_redeem_point') . ':'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" /> @show_tooltip(__('lang_v1.min_redeem_point_tooltip'))
            @php
            $__f15 = ['name' => 'min_redeem_point', 'value' => $business->min_redeem_point, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.min_redeem_point')]];
            @endphp
            <x-form.input type="number" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-4">
        <div class="form-group">
            @php
            $__f16 = ['name' => 'max_redeem_point', 'value' => __('lang_v1.max_redeem_point') . ':'];
            @endphp
            <x-form.label :name="$__f16['name']" :value="$__f16['value']" /> @show_tooltip(__('lang_v1.max_redeem_point_tooltip'))
            @php
            $__f17 = ['name' => 'max_redeem_point', 'value' => $business->max_redeem_point, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.max_redeem_point')]];
            @endphp
            <x-form.input type="number" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            @php
            $__f18 = ['name' => 'rp_expiry_period', 'value' => __('lang_v1.rp_expiry_period') . ':'];
            @endphp
            <x-form.label :name="$__f18['name']" :value="$__f18['value']" /> @show_tooltip(__('lang_v1.rp_expiry_period_tooltip'))
            <div class="input-group">
                @php
                $__f19 = ['name' => 'rp_expiry_period', 'value' => $business->rp_expiry_period, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.rp_expiry_period')]];
                @endphp
                <x-form.input type="number" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
                <span class="input-group-addon">-</span>
                @php
                $__f20 = ['name' => 'rp_expiry_type', 'list' => ['month' => __('lang_v1.month'), 'year' => __('lang_v1.year')], 'selected' => $business->rp_expiry_type, 'options' => ['class' => 'form-control']];
                @endphp
                <x-form.select :name="$__f20['name']" :list="$__f20['list']" :selected="$__f20['selected']" :options="$__f20['options']" />
            </div>
        </div>
    </div>
    </div>
</div>