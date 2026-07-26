<div class="row">
    <div class="col-sm-12">
        <h4>@lang('lang_v1.weighing_scale_setting'):</h4>
        <p>@lang('lang_v1.weighing_scale_setting_help')</p>
        <br/>
    </div>

    <!-- 1st part: Prefix (here any prefix can be entered), user can leave it blank also if prefix not supported by scale.
	2nd part: Dropdown list from 1 to 9 for Barcode 0
	3rd part: Dropdown list from 1 to 5 for Quantity 
	4th part: Dropdown list from 1 to 4 for Quantity decimals. -->


    <div class="col-sm-3">
        <div class="form-group">
            @php
            $__f1 = ['name' => 'label_prefix', 'value' => __('lang_v1.weighing_barcode_prefix') . ':'];
            @endphp
            <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
             @php
             $__f2 = ['name' => 'weighing_scale_setting[label_prefix]', 'value' => isset($weighing_scale_setting['label_prefix']) ? $weighing_scale_setting['label_prefix'] : null, 'options' => ['class' => 'form-control', 'id' => 'label_prefix']];
             @endphp
             <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            @php
            $__f3 = ['name' => 'product_sku_length', 'value' => __('lang_v1.weighing_product_sku_length') . ':'];
            @endphp
            <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
            
            @php
            $__f4 = ['name' => 'weighing_scale_setting[product_sku_length]', 'list' => [1,2,3,4,5,6,7,8,9], 'selected' => isset($weighing_scale_setting['product_sku_length']) ? $weighing_scale_setting['product_sku_length'] : 4, 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'product_sku_length']];
            @endphp
            <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            @php
            $__f5 = ['name' => 'qty_length', 'value' => __('lang_v1.weighing_qty_integer_part_length') . ':'];
            @endphp
            <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
            
            @php
            $__f6 = ['name' => 'weighing_scale_setting[qty_length]', 'list' => [1,2,3,4,5], 'selected' => isset($weighing_scale_setting['qty_length']) ? $weighing_scale_setting['qty_length'] : 3, 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'qty_length']];
            @endphp
            <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            @php
            $__f7 = ['name' => 'qty_length_decimal', 'value' => __('lang_v1.weighing_qty_fractional_part_length') . ':'];
            @endphp
            <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
            @php
            $__f8 = ['name' => 'weighing_scale_setting[qty_length_decimal]', 'list' => [1,2,3,4], 'selected' => isset($weighing_scale_setting['qty_length_decimal']) ? $weighing_scale_setting['qty_length_decimal'] : 2, 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'qty_length_decimal']];
            @endphp
            <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
        </div>
    </div>
</div>