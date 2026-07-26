<!--Purchase related settings -->
<div class="pos-tab-content">
    <div class="row">
    @if(!config('constants.disable_purchase_in_other_currency', true))
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                @php
                $__f1 = ['name' => 'purchase_in_diff_currency', 'value' => 1, 'checked' => $business->purchase_in_diff_currency, 'options' => [ 'class' => 'input-icheck', 'id' => 'purchase_in_diff_currency']];
                @endphp
                <x-form.checkbox :name="$__f1['name']" :value="$__f1['value']" :checked="$__f1['checked']" :options="$__f1['options']" /> {{ __( 'purchase.allow_purchase_different_currency' ) }}
                </label>
              @show_tooltip(__('tooltip.purchase_different_currency'))
            </div>
        </div>
    </div>
    <div class="col-sm-4 @if($business->purchase_in_diff_currency != 1) hide @endif" id="settings_purchase_currency_div">
        <div class="form-group">
            @php
            $__f2 = ['name' => 'purchase_currency_id', 'value' => __('purchase.purchase_currency') . ':'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fas fa-money-bill-alt"></i>
                </span>
                @php
                $__f3 = ['name' => 'purchase_currency_id', 'list' => $currencies, 'selected' => $business->purchase_currency_id, 'options' => ['class' => 'form-control select2', 'placeholder' => __('business.currency'), 'required', 'style' => 'width:100% !important']];
                @endphp
                <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
            </div>
        </div>
    </div>
    <div class="col-sm-4 @if($business->purchase_in_diff_currency != 1) hide @endif" id="settings_currency_exchange_div">
        <div class="form-group">
            @php
            $__f4 = ['name' => 'p_exchange_rate', 'value' => __('purchase.p_exchange_rate') . ':'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
            @show_tooltip(__('tooltip.currency_exchange_factor'))
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                @php
                $__f5 = ['name' => 'p_exchange_rate', 'value' => $business->p_exchange_rate, 'options' => ['class' => 'form-control', 'placeholder' => __('business.p_exchange_rate'), 'required', 'step' => '0.001']];
                @endphp
                <x-form.input type="number" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
            </div>
        </div>
    </div>
    @endif
    <div class="clearfix"></div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f6 = ['name' => 'enable_editing_product_from_purchase', 'value' => 1, 'checked' => $business->enable_editing_product_from_purchase, 'options' => [ 'class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f6['name']" :value="$__f6['value']" :checked="$__f6['checked']" :options="$__f6['options']" /> {{ __( 'lang_v1.enable_editing_product_from_purchase' ) }}
              </label>
              @show_tooltip(__('lang_v1.enable_updating_product_price_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <div class="checkbox">
                <label>
                @php
                $__f7 = ['name' => 'enable_purchase_status', 'value' => 1, 'checked' => $business->enable_purchase_status, 'options' => [ 'class' => 'input-icheck', 'id' => 'enable_purchase_status']];
                @endphp
                <x-form.checkbox :name="$__f7['name']" :value="$__f7['value']" :checked="$__f7['checked']" :options="$__f7['options']" /> {{ __( 'lang_v1.enable_purchase_status' ) }}
                </label>
              @show_tooltip(__('lang_v1.tooltip_enable_purchase_status'))
            </div>
        </div>
    </div>
<div class="clearfix"></div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="checkbox">
                <label>
                @php
                $__f8 = ['name' => 'enable_lot_number', 'value' => 1, 'checked' => $business->enable_lot_number, 'options' => [ 'class' => 'input-icheck', 'id' => 'enable_lot_number']];
                @endphp
                <x-form.checkbox :name="$__f8['name']" :value="$__f8['value']" :checked="$__f8['checked']" :options="$__f8['options']" /> {{ __( 'lang_v1.enable_lot_number' ) }}
                </label>
              @show_tooltip(__('lang_v1.tooltip_enable_lot_number'))
            </div>
        </div>
    </div>

    </div>
</div>