<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
    @php
    $__f1 = ['options' => ['url' => action('ProductController@saveQuickProduct'), 'method' => 'post', 'id' => 'quick_add_product_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <h4 class="modal-title" id="modalTitle">@lang( 'product.add_new_product' )</h4>
   </div>
   <div class="modal-body">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          @php
          $__f2 = ['name' => 'name', 'value' => __('product.product_name') . ':*'];
          @endphp
          <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'name', 'value' => $product_name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('product.product_name')]];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          @php
          $__f4 = ['name' => 'type', 'list' => ['single' => 'Single', 'variable' => 'Variable'], 'selected' => 'single', 'options' => ['class' => 'hide', 'id' => 'type']];
          @endphp
          <x-form.select :name="$__f4['name']" :list="$__f4['list']" :selected="$__f4['selected']" :options="$__f4['options']" />
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          @php
          $__f5 = ['name' => 'sku', 'value' => __('product.sku') . ':'];
          @endphp
          <x-form.label :name="$__f5['name']" :value="$__f5['value']" /> @show_tooltip(__('tooltip.sku'))
          @php
          $__f6 = ['name' => 'sku', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('product.sku')]];
          @endphp
          <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          @php
          $__f7 = ['name' => 'barcode_type', 'value' => __('product.barcode_type') . ':*'];
          @endphp
          <x-form.label :name="$__f7['name']" :value="$__f7['value']" />
          @php
          $__f8 = ['name' => 'barcode_type', 'list' => $barcode_types, 'selected' => 'C128', 'options' => ['class' => 'form-control select2', 'required']];
          @endphp
          <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="col-sm-4">
        <div class="form-group">
          @php
          $__f9 = ['name' => 'unit_id', 'value' => __('product.unit') . ':*'];
          @endphp
          <x-form.label :name="$__f9['name']" :value="$__f9['value']" />
          @php
          $__f10 = ['name' => 'unit_id', 'list' => $units, 'selected' => null, 'options' => ['class' => 'form-control select2', 'required']];
          @endphp
          <x-form.select :name="$__f10['name']" :list="$__f10['list']" :selected="$__f10['selected']" :options="$__f10['options']" />
        </div>
      </div>

      <div class="col-sm-4 @if(!session('business.enable_sub_units')) hide @endif">
        <div class="form-group">
          @php
          $__f11 = ['name' => 'sub_unit_ids', 'value' => __('lang_v1.related_sub_units') . ':'];
          @endphp
          <x-form.label :name="$__f11['name']" :value="$__f11['value']" /> @show_tooltip(__('lang_v1.sub_units_tooltip'))

          @php
          $__f12 = ['name' => 'sub_unit_ids[]', 'list' => [], 'selected' => null, 'options' => ['class' => 'form-control select2', 'multiple', 'id' => 'sub_unit_ids']];
          @endphp
          <x-form.select :name="$__f12['name']" :list="$__f12['list']" :selected="$__f12['selected']" :options="$__f12['options']" />
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          @php
          $__f13 = ['name' => 'brand_id', 'value' => __('product.brand') . ':'];
          @endphp
          <x-form.label :name="$__f13['name']" :value="$__f13['value']" />
          @php
          $__f14 = ['name' => 'brand_id', 'list' => $brands, 'selected' => null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']];
          @endphp
          <x-form.select :name="$__f14['name']" :list="$__f14['list']" :selected="$__f14['selected']" :options="$__f14['options']" />
        </div>
      </div>

      <div class="clearfix"></div>
      <div class="col-sm-4">
        <div class="form-group">
          @php
          $__f15 = ['name' => 'category_id', 'value' => __('product.category') . ':'];
          @endphp
          <x-form.label :name="$__f15['name']" :value="$__f15['value']" />
          @php
          $__f16 = ['name' => 'category_id', 'list' => $categories, 'selected' => null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']];
          @endphp
          <x-form.select :name="$__f16['name']" :list="$__f16['list']" :selected="$__f16['selected']" :options="$__f16['options']" />
        </div>
      </div>

      <div class="col-sm-4 @if(!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
        <div class="form-group">
          @php
          $__f17 = ['name' => 'sub_category_id', 'value' => __('product.sub_category') . ':'];
          @endphp
          <x-form.label :name="$__f17['name']" :value="$__f17['value']" />
          @php
          $__f18 = ['name' => 'sub_category_id', 'list' => [], 'selected' => null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']];
          @endphp
          <x-form.select :name="$__f18['name']" :list="$__f18['list']" :selected="$__f18['selected']" :options="$__f18['options']" />
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <br>
          <label>
            @php
            $__f19 = ['name' => 'enable_stock', 'value' => 1, 'checked' => true, 'options' => ['class' => 'input-icheck', 'id' => 'enable_stock']];
            @endphp
            <x-form.checkbox :name="$__f19['name']" :value="$__f19['value']" :checked="$__f19['checked']" :options="$__f19['options']" /> <strong>@lang('product.manage_stock')</strong>
          </label>@show_tooltip(__('tooltip.enable_stock')) <p class="help-block"><i>@lang('product.enable_stock_help')</i></p>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-sm-4" id="alert_quantity_div">
        <div class="form-group">
          @php
          $__f20 = ['name' => 'alert_quantity', 'value' => __('product.alert_quantity') . ':'];
          @endphp
          <x-form.label :name="$__f20['name']" :value="$__f20['value']" />
          @php
          $__f21 = ['name' => 'alert_quantity', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('product.alert_quantity'), 'min' => '0']];
          @endphp
          <x-form.input type="number" :name="$__f21['name']" :value="$__f21['value']" :options="$__f21['options']" />
        </div>
      </div>
      @if(!empty($common_settings['enable_product_warranty']))
      <div class="col-sm-4">
        <div class="form-group">
          @php
          $__f22 = ['name' => 'warranty_id', 'value' => __('lang_v1.warranty') . ':'];
          @endphp
          <x-form.label :name="$__f22['name']" :value="$__f22['value']" />
          @php
          $__f23 = ['name' => 'warranty_id', 'list' => $warranties, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]];
          @endphp
          <x-form.select :name="$__f23['name']" :list="$__f23['list']" :selected="$__f23['selected']" :options="$__f23['options']" />
        </div>
      </div>
      @endif
      @if(session('business.enable_product_expiry'))
      @if(session('business.expiry_type') == 'add_expiry')
      @php
      $expiry_period = 12;
      $hide = true;
      @endphp
      @else
      @php
      $expiry_period = null;
      $hide = false;
      @endphp
      @endif
      <div class="col-sm-4 @if($hide) hide @endif">
        <div class="form-group">
          <div class="multi-input">
            @php
            $__f24 = ['name' => 'expiry_period', 'value' => __('product.expires_in') . ':'];
            @endphp
            <x-form.label :name="$__f24['name']" :value="$__f24['value']" /><br>
            @php
            $__f25 = ['name' => 'expiry_period', 'value' => $expiry_period, 'options' => ['class' => 'form-control pull-left input_number', 'placeholder' => __('product.expiry_period'), 'style' => 'width:60%;']];
            @endphp
            <x-form.input type="text" :name="$__f25['name']" :value="$__f25['value']" :options="$__f25['options']" />
            @php
            $__f26 = ['name' => 'expiry_period_type', 'list' => ['months'=>__('product.months'), 'days'=>__('product.days'), '' =>__('product.not_applicable') ], 'selected' => 'months', 'options' => ['class' => 'form-control select2 pull-left', 'style' => 'width:40%;', 'id' => 'expiry_period_type']];
            @endphp
            <x-form.select :name="$__f26['name']" :list="$__f26['list']" :selected="$__f26['selected']" :options="$__f26['options']" />
          </div>
        </div>
      </div>
      @endif
      @php
      $default_location = null;
      if(count($business_locations) == 1){
      $default_location = array_key_first($business_locations->toArray());
    }
    @endphp
    <div class="col-sm-4">
      <div class="form-group">
        @php
        $__f27 = ['name' => 'product_locations', 'value' => __('business.business_locations') . ':'];
        @endphp
        <x-form.label :name="$__f27['name']" :value="$__f27['value']" /> @show_tooltip(__('lang_v1.product_location_help'))
        @php
        $__f28 = ['name' => 'product_locations[]', 'list' => $business_locations, 'selected' => $default_location, 'options' => ['class' => 'form-control select2', 'multiple', 'id' => 'product_locations']];
        @endphp
        <x-form.select :name="$__f28['name']" :list="$__f28['list']" :selected="$__f28['selected']" :options="$__f28['options']" />
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        @php
        $__f29 = ['name' => 'weight', 'value' => __('lang_v1.weight') . ':'];
        @endphp
        <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
        @php
        $__f30 = ['name' => 'weight', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.weight')]];
        @endphp
        <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-8">
      <div class="form-group">
        @php
        $__f31 = ['name' => 'product_description', 'value' => __('lang_v1.product_description') . ':'];
        @endphp
        <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
        @php
        $__f32 = ['name' => 'product_description', 'value' => null, 'options' => ['class' => 'form-control']];
        @endphp
        <x-form.textarea :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-4">
      <div class="form-group">
        @php
        $__f33 = ['name' => 'tax', 'value' => __('product.applicable_tax') . ':'];
        @endphp
        <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
        @php
        $__f34 = ['name' => 'tax', 'list' => $taxes, 'selected' => null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2'], 'optionsAttributes' => $tax_attributes];
        @endphp
        <x-form.select :name="$__f34['name']" :list="$__f34['list']" :selected="$__f34['selected']" :options="$__f34['options']" :options-attributes="$__f34['optionsAttributes']" />
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        @php
        $__f35 = ['name' => 'tax_type', 'value' => __('product.selling_price_tax_type') . ':*'];
        @endphp
        <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
        @php
        $__f36 = ['name' => 'tax_type', 'list' => ['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], 'selected' => 'exclusive', 'options' => ['class' => 'form-control select2', 'required']];
        @endphp
        <x-form.select :name="$__f36['name']" :list="$__f36['list']" :selected="$__f36['selected']" :options="$__f36['options']" />
      </div>
    </div>
    <div class="col-sm-4">
      <div class="checkbox">
        <br>
        <label>
          @php
          $__f37 = ['name' => 'enable_sr_no', 'value' => 1, 'checked' => false, 'options' => ['class' => 'input-icheck']];
          @endphp
          <x-form.checkbox :name="$__f37['name']" :value="$__f37['value']" :checked="$__f37['checked']" :options="$__f37['options']" /> <strong>@lang('lang_v1.enable_imei_or_sr_no')</strong>
        </label>@show_tooltip(__('lang_v1.tooltip_sr_no'))
      </div>
    </div>
    <div class="clearfix"></div>
    @php
    $custom_labels = json_decode(session('business.custom_labels'), true);
    $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
    $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
    $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
    $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
    @endphp
    <div class="col-sm-4">
      <div class="form-group">
        <br>
        <label>
          @php
          $__f38 = ['name' => 'not_for_selling', 'value' => 1, 'checked' => false, 'options' => ['class' => 'input-icheck']];
          @endphp
          <x-form.checkbox :name="$__f38['name']" :value="$__f38['value']" :checked="$__f38['checked']" :options="$__f38['options']" /> <strong>@lang('lang_v1.not_for_selling')</strong>
        </label> @show_tooltip(__('lang_v1.tooltip_not_for_selling'))
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
      <div class="form-group">
        @php
        $__f39 = ['name' => 'product_custom_field1', 'value' => $product_custom_field1 . ':'];
        @endphp
        <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
        @php
        $__f40 = ['name' => 'product_custom_field1', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $product_custom_field1]];
        @endphp
        <x-form.input type="text" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />
      </div>
    </div>

    <div class="col-sm-3">
      <div class="form-group">
        @php
        $__f41 = ['name' => 'product_custom_field2', 'value' => $product_custom_field2 . ':'];
        @endphp
        <x-form.label :name="$__f41['name']" :value="$__f41['value']" />
        @php
        $__f42 = ['name' => 'product_custom_field2', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $product_custom_field2]];
        @endphp
        <x-form.input type="text" :name="$__f42['name']" :value="$__f42['value']" :options="$__f42['options']" />
      </div>
    </div>

    <div class="col-sm-3">
      <div class="form-group">
        @php
        $__f43 = ['name' => 'product_custom_field3', 'value' => $product_custom_field3 . ':'];
        @endphp
        <x-form.label :name="$__f43['name']" :value="$__f43['value']" />
        @php
        $__f44 = ['name' => 'product_custom_field3', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $product_custom_field3]];
        @endphp
        <x-form.input type="text" :name="$__f44['name']" :value="$__f44['value']" :options="$__f44['options']" />
      </div>
    </div>

    <div class="col-sm-3">
      <div class="form-group">
        @php
        $__f45 = ['name' => 'product_custom_field4', 'value' => $product_custom_field4 . ':'];
        @endphp
        <x-form.label :name="$__f45['name']" :value="$__f45['value']" />
        @php
        $__f46 = ['name' => 'product_custom_field4', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => $product_custom_field4]];
        @endphp
        <x-form.input type="text" :name="$__f46['name']" :value="$__f46['value']" :options="$__f46['options']" />
      </div>
    </div>
    <div class="clearfix"></div>


    <div class="col-sm-3">
      <div class="form-group">
        <label for="product_custom_field2">%ICMS:</label>
        <input required value="0.00" class="form-control" placeholder="%ICMS" name="perc_icms" type="number" id="perc_icms">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <label for="product_custom_field2">%PIS:</label>
        <input required value="0.00" class="form-control" placeholder="%PIS" name="perc_pis" type="number" id="perc_pis">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <label for="product_custom_field2">%COFINS:</label>
        <input required value="0.00" class="form-control" placeholder="%COFINS" name="perc_cofins" type="number" id="perc_cofins">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <label for="product_custom_field2">%IPI:</label>
        <input required value="0.00" class="form-control" placeholder="%IPI" name="perc_ipi" type="number" id="perc_ipi">
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        @php
        $__f47 = ['name' => 'cst_csosn', 'value' => 'CST/CSOSN' . ':*'];
        @endphp
        <x-form.label :name="$__f47['name']" :value="$__f47['value']" />
        @php
        $__f48 = ['name' => 'cst_csosn', 'list' => $listaCSTCSOSN, 'selected' => $business->cst_csosn_padrao, 'options' => ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
        @endphp
        <x-form.select :name="$__f48['name']" :list="$__f48['list']" :selected="$__f48['selected']" :options="$__f48['options']" />
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        @php
        $__f49 = ['name' => 'cst_pis', 'value' => 'CST/PIS' . ':*'];
        @endphp
        <x-form.label :name="$__f49['name']" :value="$__f49['value']" /> 
        @php
        $__f50 = ['name' => 'cst_pis', 'list' => $listaCST_PIS_COFINS, 'selected' => $business->cst_pis_padrao, 'options' => ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
        @endphp
        <x-form.select :name="$__f50['name']" :list="$__f50['list']" :selected="$__f50['selected']" :options="$__f50['options']" />
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        @php
        $__f51 = ['name' => 'cst_cofins', 'value' => 'CST/COFINS' . ':*'];
        @endphp
        <x-form.label :name="$__f51['name']" :value="$__f51['value']" /> 
        @php
        $__f52 = ['name' => 'cst_cofins', 'list' => $listaCST_PIS_COFINS, 'selected' => $business->cst_cofins_padrao, 'options' => ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
        @endphp
        <x-form.select :name="$__f52['name']" :list="$__f52['list']" :selected="$__f52['selected']" :options="$__f52['options']" />
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        @php
        $__f53 = ['name' => 'cst_ipi', 'value' => 'CST/IPI' . ':*'];
        @endphp
        <x-form.label :name="$__f53['name']" :value="$__f53['value']" /> 
        @php
        $__f54 = ['name' => 'cst_ipi', 'list' => $listaCST_IPI, 'selected' => $business->cst_ipi_padrao, 'options' => ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
        @endphp
        <x-form.select :name="$__f54['name']" :list="$__f54['list']" :selected="$__f54['selected']" :options="$__f54['options']" />
      </div>
    </div>

    <div class="col-sm-2">
      <div class="form-group">
        <label for="product_custom_field2">CFOP Estadual*:</label>
        <input value="{{$business->cfop_saida_estadual_padrao}}" required class="form-control" data-mask="0000" placeholder="CFOP Estadual" name="cfop_interno" type="number" id="cfop_interno">
      </div>
    </div>

    <div class="col-sm-2">
      <div class="form-group">
        <label for="product_custom_field2">CFOP Inter estadual*:</label>
        <input value="{{$business->cfop_saida_inter_estadual_padrao}}" required class="form-control" data-mask="0000" placeholder="CFOP Inter estadual" name="cfop_externo" type="text" id="cfop_externo">
      </div>
    </div>

    <div class="col-sm-2">
      <div class="form-group">
        <label for="product_custom_field2">NCM*:</label>
        <input value="{{$business->ncm_padrao}}" required class="form-control" placeholder="NCM" data-mask="0000.00.00" name="ncm" type="text">
      </div>
    </div>

    <div class="col-sm-2">
      <div class="form-group">
        <label for="product_custom_field2">CEST:</label>
        <input class="form-control" placeholder="CEST" name="cest" type="number" id="cest">
      </div>
    </div>

    <div class="col-sm-4">
      <div class="form-group">
        @php
        $__f55 = ['name' => 'origem', 'value' => 'Origem' . ':'];
        @endphp
        <x-form.label :name="$__f55['name']" :value="$__f55['value']" />
        @php
        $__f56 = ['name' => 'origem', 'list' => App\Models\Product::listaOrigem(), 'selected' => '', 'options' => ['class' => 'form-control select2']];
        @endphp
        <x-form.select :name="$__f56['name']" :list="$__f56['list']" :selected="$__f56['selected']" :options="$__f56['options']" />
      </div>
    </div>

    <div class="clearfix"></div>
    @if(!empty($module_form_parts))
    @foreach($module_form_parts as $key => $value)
    @if(!empty($value['template_path']))
    @php
    $template_data = $value['template_data'] ?: [];
    @endphp
    @include($value['template_path'], $template_data)
    @endif
    @endforeach
    @endif
  </div>
  <div class="row">
    <div class="form-group col-sm-12">
      @include('product.partials.single_product_form_part', ['profit_percent' => $default_profit_percent, 'quick_add' => true ])
    </div>
  </div>
  @if(!empty($product_for) && $product_for == 'pos')
  @include('product.partials.quick_product_opening_stock', ['locations' => $locations])
  @endif
</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-primary" id="submit_quick_product">@lang( 'messages.save' )</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
</div>

<x-form.close />

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
  $(document).ready(function(){
    $("form#quick_add_product_form").validate({
      rules: {
        sku: {
          remote: {
            url: "/products/check_product_sku",
            type: "post",
            data: {
              sku: function() {
                return $( "#sku" ).val();
              },
              product_id: function() {
                if($('#product_id').length > 0 ){
                  return $('#product_id').val();
                } else {
                  return '';
                }
              },
            }
          }
        },
        expiry_period:{
          required: {
            depends: function(element) {
              return ($('#expiry_period_type').val().trim() != '');
            }
          }
        }
      },
      messages: {
        sku: {
          remote: LANG.sku_already_exists
        }
      },
      submitHandler: function (form) {

        var form = $("form#quick_add_product_form");
        var url = form.attr('action');
        form.find('button[type="submit"]').attr('disabled', true);
        $.ajax({
          method: "POST",
          url: url,
          dataType: 'json',
          data: $(form).serialize(),
          success: function(data){
            $('.quick_add_product_modal').modal('hide');
            if( data.success){
              toastr.success(data.msg);
              if (typeof get_purchase_entry_row !== 'undefined') {
                var selected_location = $('#location_id').val();
                var location_check = true;
                if (data.locations && selected_location && data.locations.indexOf(selected_location) == -1) {
                  location_check = false;
                }
                if (location_check) {
                  get_purchase_entry_row( data.product.id, 0 );
                }

              }
              $(document).trigger({type: "quickProductAdded", 'product': data.product, 'variation': data.variation });
            } else {
              toastr.error(data.msg);
            }
          }
        });
        return false;
      }
    });
  });
</script>