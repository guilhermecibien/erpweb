
@if(!session('business.enable_price_tax')) 
    @php
        $default = 0;
        $class = 'hide';
    @endphp
@else
    @php
        $default = null;
        $class = '';
    @endphp
@endif

<tr class="variation_row">
    <td>
        @php
        $__f1 = ['name' => 'product_variation[' . $row_index .'][variation_template_id]', 'list' => $variation_templates, 'selected' => null, 'options' => ['class' => 'form-control input-sm variation_template', 'required']];
        @endphp
        <x-form.select :name="$__f1['name']" :list="$__f1['list']" :selected="$__f1['selected']" :options="$__f1['options']" />
        <input type="hidden" class="row_index" value="{{$row_index}}">
    </td>

    <td>
        <table class="table table-condensed table-bordered blue-header variation_value_table">
            <thead>
            <tr>
                <th>@lang('product.sku') @show_tooltip(__('tooltip.sub_sku'))</th>
                <th>@lang('product.value')</th>
                <th class="{{$class}}">@lang('product.default_purchase_price')
                    <br/>
                    <span class="pull-left"><small><i>@lang('product.exc_of_tax')</i></small></span>

                    <span class="pull-right"><small><i>@lang('product.inc_of_tax')</i></small></span>
                </th>
                <th class="{{$class}}">@lang('product.profit_percent')</th>
                <th class="{{$class}}">@lang('product.default_selling_price')
                <br/>
                <small><i><span class="dsp_label"></span></i></small>
                    <!-- &nbsp;&nbsp;<b><i class="fa fa-info-circle" aria-hidden="true" data-toggle="popover" data-html="true" data-trigger="hover" data-content="<p class='text-primary'>Drag the mouse over the table cells to copy input values</p>" data-placement="top"></i></b> -->
                </th>
                <th>@lang('lang_v1.variation_images')</th>
                <th><button type="button" class="btn btn-success btn-xs add_variation_value_row">+</button></th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>
                    @php
                    $__f2 = ['name' => 'product_variation[' . $row_index .'][variations][0][sub_sku]', 'value' => null, 'options' => ['class' => 'form-control input-sm']];
                    @endphp
                    <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
                </td>
                <td>
                    @php
                    $__f3 = ['name' => 'product_variation[' . $row_index .'][variations][0][value]', 'value' => null, 'options' => ['class' => 'form-control input-sm variation_value_name', 'required']];
                    @endphp
                    <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
                </td>
                <td class="{{$class}}">
                    <div class="width-50 f-left">
                        @php
                        $__f4 = ['name' => 'product_variation[' . $row_index .'][variations][0][default_purchase_price]', 'value' => $default, 'options' => ['class' => 'form-control input-sm variable_dpp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']];
                        @endphp
                        <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
                    </div>

                    <div class="width-50 f-left">
                        <div class="input-group">
                            @php
                            $__f5 = ['name' => 'product_variation[' . $row_index .'][variations][0][dpp_inc_tax]', 'value' => $default, 'options' => ['class' => 'form-control input-sm variable_dpp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']];
                            @endphp
                            <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-toggle="tooltip" title="@lang('lang_v1.apply_all')" data-target-class=".variable_dpp_inc_tax"><i class="fas fa-check-double"></i></button>
                            </span>
                        </div>
                    </div>
                </td>
                <td class="{{$class}}">
                    <div class="input-group">
                        @php
                        $__f6 = ['name' => 'product_variation[' . $row_index .'][variations][0][profit_percent]', 'value' => $profit_percent, 'options' => ['class' => 'form-control input-sm variable_profit_percent input_number', 'required']];
                        @endphp
                        <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />

                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-toggle="tooltip" title="@lang('lang_v1.apply_all')" data-target-class=".variable_profit_percent"><i class="fas fa-check-double"></i></button>
                        </span>
                    </div>
                </td>
                <td class="{{$class}}">
                    @php
                    $__f7 = ['name' => 'product_variation[' . $row_index .'][variations][0][default_sell_price]', 'value' => $default, 'options' => ['class' => 'form-control input-sm variable_dsp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']];
                    @endphp
                    <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />

                     @php
                     $__f8 = ['name' => 'product_variation[' . $row_index .'][variations][0][sell_price_inc_tax]', 'value' => $default, 'options' => ['class' => 'form-control input-sm variable_dsp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']];
                     @endphp
                     <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
                </td>
                <td>@php
                <td>$__f9 = ['name' => 'variation_images_' . $row_index .'_0[]', 'options' => ['class' => 'variation_images', 'accept' => 'image/*', 'multiple']];
                <td>@endphp
                <td><x-form.input type="file" :name="$__f9['name']" :options="$__f9['options']" /></td>
                <td>
                    <button type="button" class="btn btn-danger btn-xs remove_variation_value_row">-</button>
                    <input type="hidden" class="variation_row_index" value="0">
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>