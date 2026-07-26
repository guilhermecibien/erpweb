<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f1 = ['name' => 'default_sales_discount', 'value' => __('business.default_sales_discount') . ':*'];
                @endphp
                <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-percent"></i>
                    </span>
                    @php
                    $__f2 = ['name' => 'default_sales_discount', 'value' => number_format($business->default_sales_discount, 2, ',', '.'), 'options' => ['class' => 'form-control input_number']];
                    @endphp
                    <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f3 = ['name' => 'default_sales_tax', 'value' => __('business.default_sales_tax') . ':'];
                @endphp
                <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    @php
                    $__f4 = ['name' => 'default_sales_tax', 'list' => $tax_rates, 'selected' => $business->default_sales_tax, 'options' => ['class' => 'form-control select2','placeholder' => __('business.default_sales_tax'), 'style' => 'width: 100%;']];
                    @endphp
                    <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
                </div>
            </div>
        </div>
        <!-- <div class="clearfix"></div> -->

        {{--<div class="col-sm-12 hide">
            <div class="form-group">
                @php
                $__f5 = ['name' => 'sell_price_tax', 'value' => __('business.sell_price_tax') . ':'];
                @endphp
                <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                <div class="input-group">
                    <div class="radio">
                        <label>
                            <input type="radio" name="sell_price_tax" value="includes" 
                            class="input-icheck" @if($business->sell_price_tax == 'includes') {{'checked'}} @endif> Includes the Sale Tax
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="sell_price_tax" value="excludes" 
                            class="input-icheck" @if($business->sell_price_tax == 'excludes') {{'checked'}} @endif>Excludes the Sale Tax (Calculate sale tax on Selling Price provided in Add Purchase)
                        </label>
                    </div>
                </div>
            </div>
        </div>--}}
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f6 = ['name' => 'sales_cmsn_agnt', 'value' => __('lang_v1.sales_commission_agent') . ':'];
                @endphp
                <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-info"></i>
                    </span>
                    @php
                    $__f7 = ['name' => 'sales_cmsn_agnt', 'list' => $commission_agent_dropdown, 'selected' => $business->sales_cmsn_agnt, 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%;']];
                    @endphp
                    <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f8 = ['name' => 'item_addition_method', 'value' => __('lang_v1.sales_item_addition_method') . ':'];
                @endphp
                <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
                @php
                $__f9 = ['name' => 'item_addition_method', 'list' => [ 0 => __('lang_v1.add_item_in_new_row'), 1 =>  __('lang_v1.increase_item_qty')], 'selected' => $business->item_addition_method, 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%;']];
                @endphp
                <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f10 = ['name' => 'amount_rounding_method', 'value' => __('lang_v1.amount_rounding_method') . ':'];
                @endphp
                <x-form.label :name="$__f10['name']" :value="$__f10['value']" /> @show_tooltip(__('lang_v1.amount_rounding_method_help'))
                @php
                $__f11 = ['name' => 'pos_settings[amount_rounding_method]', 'list' => [ '1' =>  __('lang_v1.round_to_nearest_whole_number'), '0.05' =>  __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.05]), '0.1' =>  __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.1]), '0.5' =>  __('lang_v1.round_to_nearest_decimal', ['multiple' => 0.5]) ], 'selected' => !empty($pos_settings['amount_rounding_method']) ? $pos_settings['amount_rounding_method'] : null, 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.none')]];
                @endphp
                <x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
            </div>
        </div>

        <div class="col-sm-8">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f12 = ['name' => 'pos_settings[enable_msp]', 'value' => 1, 'checked' => !empty($pos_settings['enable_msp']) ? true : false, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f12['name']" :value="$__f12['value']" :checked="$__f12['checked']" :options="$__f12['options']" /> {{ __( 'lang_v1.sale_price_is_minimum_sale_price' ) }} 
                  </label>
                  @show_tooltip(__('lang_v1.minimum_sale_price_help'))
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="checkbox">
                <br>
                  <label>
                    @php
                    $__f13 = ['name' => 'pos_settings[allow_overselling]', 'value' => 1, 'checked' => !empty($pos_settings['allow_overselling']) ? true : false, 'options' => [ 'class' => 'input-icheck']];
                    @endphp
                    <x-form.checkbox :name="$__f13['name']" :value="$__f13['value']" :checked="$__f13['checked']" :options="$__f13['options']" /> {{ __( 'lang_v1.allow_overselling' ) }} 
                  </label>
                  @show_tooltip(__('lang_v1.allow_overselling_help'))
                </div>
            </div>
        </div>

    </div>
</div>