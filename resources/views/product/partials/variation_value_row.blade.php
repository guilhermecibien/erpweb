@php
    $variation_name = !empty($variation_name) ? $variation_name : null;
    $variation_value_id = !empty($variation_value_id) ? $variation_value_id : null;

    $name = (empty($row_type) || $row_type == 'add') ? 'product_variation' : 'product_variation_edit';

    $readonly = !empty($variation_value_id) ? 'readonly' : '';
@endphp

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

<tr>
    <td>
        @php
        $__f1 = ['name' => $name . '[' . $variation_index . '][variations][' . $value_index . '][sub_sku]', 'value' => null, 'options' => ['class' => 'form-control input-sm']];
        @endphp
        <x-form.input type="text" :name="$__f1['name']" :value="$__f1['value']" :options="$__f1['options']" />

        @php
        $__f2 = ['name' => $name . '[' . $variation_index . '][variations][' . $value_index . '][variation_value_id]', 'value' => $variation_value_id];
        @endphp
        <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" />
    </td>
    <td>
        @php
        $__f3 = ['name' => $name . '[' . $variation_index . '][variations][' . $value_index . '][value]', 'value' => $variation_name, 'options' => ['class' => 'form-control input-sm variation_value_name', 'required', $readonly]];
        @endphp
        <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
    </td>
    <td class="{{$class}}">
        <div class="width-50 f-left">
            @php
            $__f4 = ['name' => $name . '[' . $variation_index . '][variations][' . $value_index . '][default_purchase_price]', 'value' => $default, 'options' => ['class' => 'form-control input-sm variable_dpp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']];
            @endphp
            <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
        </div>

        <div class="width-50 f-left">
            <div class="input-group">
                @php
                $__f5 = ['name' => $name . '[' . $variation_index . '][variations][' . $value_index . '][dpp_inc_tax]', 'value' => $default, 'options' => ['class' => 'form-control input-sm variable_dpp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']];
                @endphp
                <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
                @if($value_index == 0)
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-toggle="tooltip" title="@lang('lang_v1.apply_all')" data-target-class=".variable_dpp_inc_tax"><i class="fas fa-check-double"></i></button>
                    </span>
                @endif
            </div>
        </div>
    </td>
    <td class="{{$class}}">
        <div class="input-group">
            @php
            $__f6 = ['name' => $name . '[' . $variation_index . '][variations][' . $value_index . '][profit_percent]', 'value' => $profit_percent, 'options' => ['class' => 'form-control input-sm variable_profit_percent input_number', 'required']];
            @endphp
            <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
            @if($value_index == 0)
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-toggle="tooltip" title="@lang('lang_v1.apply_all')" data-target-class=".variable_profit_percent"><i class="fas fa-check-double"></i></button>
                </span>
            @endif
        </div>
    </td>
    <td class="{{$class}}">
        @php
        $__f7 = ['name' => $name . '[' . $variation_index . '][variations][' . $value_index . '][default_sell_price]', 'value' => $default, 'options' => ['class' => 'form-control input-sm variable_dsp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']];
        @endphp
        <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />

        @php
        $__f8 = ['name' => $name . '[' . $variation_index . '][variations][' . $value_index . '][sell_price_inc_tax]', 'value' => $default, 'options' => ['class' => 'form-control input-sm variable_dsp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']];
        @endphp
        <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
    </td>
    <td>@php
    <td>$__f9 = ['name' => 'variation_images_' . $variation_index . '_' . $value_index . '[]', 'options' => ['class' => 'variation_images', 'accept' => 'image/*', 'multiple']];
    <td>@endphp
    <td><x-form.input type="file" :name="$__f9['name']" :options="$__f9['options']" /></td>
    <td>
        <button type="button" class="btn btn-danger btn-xs remove_variation_value_row">-</button>
        <input type="hidden" class="variation_row_index" value="{{$value_index}}">
    </td>
</tr>