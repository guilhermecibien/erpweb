@foreach( $variations as $variation)
    <tr>
        <td><span class="sr_number"></span></td>
        <td>
            {{ $product->name }} ({{$variation->sub_sku}})
            @if( $product->type == 'variable' )
                <br/>
                (<b>{{ $variation->product_variation->name }}</b> : {{ $variation->name }})
            @endif
            @if($product->enable_stock == 1)
                <br>
                <small class="text-muted" style="white-space: nowrap;">@lang('report.current_stock'): @if(!empty($variation->variation_location_details->first())) {{@number_format($variation->variation_location_details->first()->qty_available, 2, ',', '.')}} @else 0 @endif {{ $product->unit->short_name }}</small>
            @endif
            
        </td>
        <td>
            @php
            $__f1 = ['name' => 'purchases[' . $row_count . '][product_id]', 'value' => $product->id];
            @endphp
            <x-form.input type="hidden" :name="$__f1['name']" :value="$__f1['value']" />
            @php
            $__f2 = ['name' => 'purchases[' . $row_count . '][variation_id]', 'value' => $variation->id, 'options' => ['class' => 'hidden_variation_id']];
            @endphp
            <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />

            @php
                $check_decimal = 'false';
                if($product->unit->allow_decimal == 0){
                    $check_decimal = 'true';
                }
                $currency_precision = config('constants.currency_precision', 2);
                $quantity_precision = config('constants.quantity_precision', 2);
            @endphp
            @php
            $__f3 = ['name' => 'purchases[' . $row_count . '][quantity]', 'value' => number_format(1, $quantity_precision, ',', ''), 'options' => ['class' => 'form-control input-sm purchase_quantity input_number mousetrap', 'required', 'data-rule-abs_digit' => $check_decimal, 'data-msg-abs_digit' => __('lang_v1.decimal_value_not_allowed')]];
            @endphp
            <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
            <input type="hidden" class="base_unit_cost" value="{{$variation->default_purchase_price}}">
            <input type="hidden" class="base_unit_selling_price" value="{{$variation->sell_price_inc_tax}}">

            <input type="hidden" name="purchases[{{$row_count}}][product_unit_id]" value="{{$product->unit->id}}">
            @if(!empty($sub_units))
                <br>
                <select name="purchases[{{$row_count}}][sub_unit_id]" class="form-control input-sm sub_unit">
                    @foreach($sub_units as $key => $value)
                        <option value="{{$key}}" data-multiplier="{{$value['multiplier']}}">
                            {{$value['name']}}
                        </option>
                    @endforeach
                </select>
            @else 
                {{ $product->unit->short_name }}
            @endif
        </td>
        <td>
            @php
            $__f4 = ['name' => 'purchases[' . $row_count . '][pp_without_discount]', 'value' => number_format($variation->default_purchase_price, $currency_precision, ',', ''), 'options' => ['class' => 'form-control input-sm purchase_unit_cost_without_discount input_number', 'required']];
            @endphp
            <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
        </td>
        <td>
            @php
            $__f5 = ['name' => 'purchases[' . $row_count . '][discount_percent]', 'value' => 0, 'options' => ['class' => 'form-control input-sm inline_discounts input_number', 'required']];
            @endphp
            <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
        </td>
        <td>
            @php
            $__f6 = ['name' => 'purchases[' . $row_count . '][purchase_price]', 'value' => number_format($variation->default_purchase_price, $currency_precision, ',', ''), 'options' => ['class' => 'form-control input-sm purchase_unit_cost input_number', 'required']];
            @endphp
            <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
        </td>
        <td class="{{$hide_tax}}">
            <span class="row_subtotal_before_tax display_currency">0</span>
            <input type="hidden" class="row_subtotal_before_tax_hidden" value=0>
        </td>
        <td class="{{$hide_tax}}">
            <div class="input-group">
                <select name="purchases[{{ $row_count }}][purchase_line_tax_id]" class="form-control select2 input-sm purchase_line_tax_id" placeholder="'Please Select'">
                    <option value="" data-tax_amount="0" @if( $hide_tax == 'hide' )
                    selected @endif >@lang('lang_v1.none')</option>
                    @foreach($taxes as $tax)
                        <option value="{{ $tax->id }}" data-tax_amount="{{ $tax->amount }}" @if( $product->tax == $tax->id && $hide_tax != 'hide') selected @endif >{{ $tax->name }}</option>
                    @endforeach
                </select>
                @php
                $__f7 = ['name' => 'purchases[' . $row_count . '][item_tax]', 'value' => 0, 'options' => ['class' => 'purchase_product_unit_tax']];
                @endphp
                <x-form.input type="hidden" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                <span class="input-group-addon purchase_product_unit_tax_text">
                    0.00</span>
            </div>
        </td>
        <td class="{{$hide_tax}}">
            @php
                $dpp_inc_tax = number_format($variation->dpp_inc_tax, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator);
                if($hide_tax == 'hide'){
                    $dpp_inc_tax = number_format($variation->default_purchase_price, $currency_precision, ',', '');
                }

            @endphp
            @php
            $__f8 = ['name' => 'purchases[' . $row_count . '][purchase_price_inc_tax]', 'value' => $dpp_inc_tax, 'options' => ['class' => 'form-control input-sm purchase_unit_cost_after_tax input_number', 'required']];
            @endphp
            <x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
        </td>
        <td>
            <span class="row_subtotal_after_tax display_currency">0</span>
            <input type="hidden" class="row_subtotal_after_tax_hidden" value=0>
        </td>
        <td class="@if(!session('business.enable_editing_product_from_purchase')) hide @endif">
            @php
            $__f9 = ['name' => 'purchases[' . $row_count . '][profit_percent]', 'value' => number_format($variation->profit_percent, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), 'options' => ['class' => 'form-control input-sm input_number profit_percent', 'required']];
            @endphp
            <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
        </td>
        <td>
            @if(session('business.enable_editing_product_from_purchase'))
                @php
                $__f10 = ['name' => 'purchases[' . $row_count . '][default_sell_price]', 'value' => number_format($variation->sell_price_inc_tax, $currency_precision, ',', ''), 'options' => ['class' => 'form-control input-sm input_number default_sell_price', 'required']];
                @endphp
                <x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
            @else
                {{ number_format($variation->sell_price_inc_tax, $currency_precision, ',', '')}}
            @endif
        </td>
        @if(session('business.enable_lot_number'))
            <td>
                @php
                $__f11 = ['name' => 'purchases[' . $row_count . '][lot_number]', 'value' => null, 'options' => ['class' => 'form-control input-sm']];
                @endphp
                <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
            </td>
        @endif
        @if(session('business.enable_product_expiry'))
            <td style="text-align: left;">

                {{-- Maybe this condition for checkin expiry date need to be removed --}}
                @php
                    $expiry_period_type = !empty($product->expiry_period_type) ? $product->expiry_period_type : 'month';
                @endphp
                @if(!empty($expiry_period_type))
                <input type="hidden" class="row_product_expiry" value="{{ $product->expiry_period }}">
                <input type="hidden" class="row_product_expiry_type" value="{{ $expiry_period_type }}">

                @if(session('business.expiry_type') == 'add_manufacturing')
                    @php
                        $hide_mfg = false;
                    @endphp
                @else
                    @php
                        $hide_mfg = true;
                    @endphp
                @endif

                <b class="@if($hide_mfg) hide @endif"><small>@lang('product.mfg_date'):</small></b>
                <div class="input-group @if($hide_mfg) hide @endif">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    @php
                    $__f12 = ['name' => 'purchases[' . $row_count . '][mfg_date]', 'value' => null, 'options' => ['class' => 'form-control input-sm expiry_datepicker mfg_date', 'readonly']];
                    @endphp
                    <x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
                </div>
                <b><small>@lang('product.exp_date'):</small></b>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    @php
                    $__f13 = ['name' => 'purchases[' . $row_count . '][exp_date]', 'value' => null, 'options' => ['class' => 'form-control input-sm expiry_datepicker exp_date', 'readonly']];
                    @endphp
                    <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
                </div>
                @else
                <div class="text-center">
                    @lang('product.not_applicable')
                </div>
                @endif
            </td>
        @endif
        <?php $row_count++ ;?>

        <td><i class="fa fa-times remove_purchase_entry_row text-danger" title="Remove" style="cursor:pointer;"></i></td>
    </tr>
@endforeach

<input type="hidden" id="row_count" value="{{ $row_count }}">