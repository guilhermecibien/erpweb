<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                @php
                $__f1 = ['name' => 'sku_prefix', 'value' => 'Prefixo SKU:'];
                @endphp
                <x-form.label :name="$__f1['name']" :value="$__f1['value']" />
                @php
                $__f2 = ['name' => 'sku_prefix', 'value' => $business->sku_prefix, 'options' => ['class' => 'form-control text-uppercase']];
                @endphp
                <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
            </div>
        </div>
        
        <div class="col-sm-4">
            @php
            $__f3 = ['name' => 'enable_product_expiry', 'value' => __( 'product.enable_product_expiry' ) . ':'];
            @endphp
            <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
            @show_tooltip(__('lang_v1.tooltip_enable_expiry'))

            <div class="input-group">
                <span class="input-group-addon">
                    @php
                    $__f4 = ['name' => 'enable_product_expiry', 'value' => 1, 'checked' => $business->enable_product_expiry];
                    @endphp
                    <x-form.checkbox :name="$__f4['name']" :value="$__f4['value']" :checked="$__f4['checked']" /> 
                </span>

                <select class="form-control" id="expiry_type"
                name="expiry_type" 
                @if(!$business->enable_product_expiry) disabled @endif>
                <option value="add_expiry" @if($business->expiry_type == 'add_expiry') selected @endif>
                    {{__('lang_v1.add_expiry')}}
                </option>
                <option value="add_manufacturing" @if($business->expiry_type == 'add_manufacturing') selected @endif>{{__('lang_v1.add_manufacturing_auto_expiry')}}</option>
            </select>
        </div>
    </div>

    <div class="col-sm-4 @if(!$business->enable_product_expiry) hide @endif" id="on_expiry_div">
        <div class="form-group">
            <div class="multi-input">
                @php
                $__f5 = ['name' => 'on_product_expiry', 'value' => __('lang_v1.on_product_expiry') . ':'];
                @endphp
                <x-form.label :name="$__f5['name']" :value="$__f5['value']" />
                @show_tooltip(__('lang_v1.tooltip_on_product_expiry'))
                <br>

                @php
                $__f6 = ['name' => 'on_product_expiry', 'list' => ['keep_selling'=>__('lang_v1.keep_selling'), 'stop_selling'=>__('lang_v1.stop_selling') ], 'selected' => $business->on_product_expiry, 'options' => ['class' => 'form-control pull-left', 'style' => 'width:60%;']];
                @endphp
                <x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />

                @php
                $disabled = '';
                if($business->on_product_expiry == 'keep_selling'){
                $disabled = 'disabled';
            }
            @endphp

            @php
            $__f7 = ['name' => 'stop_selling_before', 'value' => $business->stop_selling_before, 'options' => ['class' => 'form-control pull-left', 'placeholder' => 'stop n days before', 'style' => 'width:40%;', $disabled, 'required', 'id' => 'stop_selling_before']];
            @endphp
            <x-form.input type="number" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f8 = ['name' => 'enable_brand', 'value' => 1, 'checked' => $business->enable_brand, 'options' => [ 'class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f8['name']" :value="$__f8['value']" :checked="$__f8['checked']" :options="$__f8['options']" /> {{ __( 'lang_v1.enable_brand' ) }}
            </label>
        </div>
    </div>
</div>

<div class="col-sm-4">
    <div class="form-group">
        <div class="checkbox">
          <label>
            @php
            $__f9 = ['name' => 'enable_category', 'value' => 1, 'checked' => $business->enable_category, 'options' => [ 'class' => 'input-icheck', 'id' => 'enable_category']];
            @endphp
            <x-form.checkbox :name="$__f9['name']" :value="$__f9['value']" :checked="$__f9['checked']" :options="$__f9['options']" /> {{ __( 'lang_v1.enable_category' ) }}
        </label>
    </div>
</div>
</div>

<div class="col-sm-4 enable_sub_category @if($business->enable_category != 1) hide @endif">
    <div class="form-group">
        <div class="checkbox">
          <label>
            @php
            $__f10 = ['name' => 'enable_sub_category', 'value' => 1, 'checked' => $business->enable_sub_category, 'options' => [ 'class' => 'input-icheck', 'id' => 'enable_sub_category']];
            @endphp
            <x-form.checkbox :name="$__f10['name']" :value="$__f10['value']" :checked="$__f10['checked']" :options="$__f10['options']" /> {{ __( 'lang_v1.enable_sub_category' ) }}
        </label>
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
              <label>
                @php
                $__f11 = ['name' => 'enable_price_tax', 'value' => 1, 'checked' => $business->enable_price_tax, 'options' => [ 'class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f11['name']" :value="$__f11['value']" :checked="$__f11['checked']" :options="$__f11['options']" /> {{ __( 'lang_v1.enable_price_tax' ) }}
            </label>
        </div>
    </div>
</div>

<div class="col-sm-4">
    <div class="form-group">
        @php
        $__f12 = ['name' => 'default_unit', 'value' => 'Unidade padrão:'];
        @endphp
        <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-balance-scale"></i>
            </span>
            @php
            $__f13 = ['name' => 'default_unit', 'list' => $units_dropdown, 'selected' => $business->default_unit, 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%;' ]];
            @endphp
            <x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
        </div>
    </div>
</div>

<div class="col-sm-4">
    <div class="form-group">
        <div class="checkbox">
          <label>
            @php
            $__f14 = ['name' => 'enable_sub_units', 'value' => 1, 'checked' => $business->enable_sub_units, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f14['name']" :value="$__f14['value']" :checked="$__f14['checked']" :options="$__f14['options']" /> {{ __( 'lang_v1.enable_sub_units' ) }}
        </label>
        @show_tooltip(__('lang_v1.sub_units_tooltip'))
    </div>
</div>
</div>

<div class="clearfix"></div>

<div class="col-sm-4">
    <div class="form-group">
        <div class="checkbox">
          <label>
            @php
            $__f15 = ['name' => 'enable_racks', 'value' => 1, 'checked' => $business->enable_racks, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f15['name']" :value="$__f15['value']" :checked="$__f15['checked']" :options="$__f15['options']" /> {{ __( 'lang_v1.enable_racks' ) }}
        </label>
        @show_tooltip(__('lang_v1.tooltip_enable_racks'))
    </div>
</div>
</div>

<div class="col-sm-4">
    <div class="form-group">
        <div class="checkbox">
          <label>
            @php
            $__f16 = ['name' => 'enable_row', 'value' => 1, 'checked' => $business->enable_row, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f16['name']" :value="$__f16['value']" :checked="$__f16['checked']" :options="$__f16['options']" /> {{ __( 'lang_v1.enable_row' ) }}
        </label>
    </div>
</div>
</div>



<div class="col-sm-4">
    <div class="form-group">
        <div class="checkbox">
          <label>
            @php
            $__f17 = ['name' => 'enable_position', 'value' => 1, 'checked' => $business->enable_position, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f17['name']" :value="$__f17['value']" :checked="$__f17['checked']" :options="$__f17['options']" /> {{ __( 'lang_v1.enable_position' ) }}
        </label>
    </div>
</div>
</div>

<div class="clearfix"></div>

<div class="col-sm-4">
    <div class="form-group">
        <div class="checkbox">
          <label>
            @php
            $__f18 = ['name' => 'common_settings[enable_product_warranty]', 'value' => 1, 'checked' => !empty($common_settings['enable_product_warranty']) ? true : false, 'options' => [ 'class' => 'input-icheck']];
            @endphp
            <x-form.checkbox :name="$__f18['name']" :value="$__f18['value']" :checked="$__f18['checked']" :options="$__f18['options']" /> {{ __( 'lang_v1.enable_product_warranty' ) }}
        </label>
    </div>
</div>
</div>

<div class="clearfix"></div>


<div class="col-sm-6">
    <div class="form-group">
        @php
        $__f19 = ['name' => 'cst_csosn_padrao', 'value' => 'CST/CSOSN Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f19['name']" :value="$__f19['value']" />
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fas fa-circle"></i>
            </span>
            @php
            $__f20 = ['name' => 'cst_csosn_padrao', 'list' => $listaCSTCSOSN, 'selected' => $business->cst_csosn_padrao, 'options' => ['class' => 'form-control', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
            @endphp
            <x-form.select :name="$__f20['name']" :list="$__f20['list']" :selected="$__f20['selected']" :options="$__f20['options']" />
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        @php
        $__f21 = ['name' => 'cst_pis_padrao', 'value' => 'CST/PIS Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f21['name']" :value="$__f21['value']" />
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fas fa-circle"></i>
            </span>
            @php
            $__f22 = ['name' => 'cst_pis_padrao', 'list' => $listaCST_PIS_COFINS, 'selected' => $business->cst_pis_padrao, 'options' => ['class' => 'form-control', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
            @endphp
            <x-form.select :name="$__f22['name']" :list="$__f22['list']" :selected="$__f22['selected']" :options="$__f22['options']" />
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        @php
        $__f23 = ['name' => 'cst_cofins_padrao', 'value' => 'CST/COFINS Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f23['name']" :value="$__f23['value']" />
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fas fa-circle"></i>
            </span>
            @php
            $__f24 = ['name' => 'cst_cofins_padrao', 'list' => $listaCST_PIS_COFINS, 'selected' => $business->cst_cofins_padrao, 'options' => ['class' => 'form-control', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
            @endphp
            <x-form.select :name="$__f24['name']" :list="$__f24['list']" :selected="$__f24['selected']" :options="$__f24['options']" />
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        @php
        $__f25 = ['name' => 'cst_ipi_padrao', 'value' => 'CST/IPI Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fas fa-circle"></i>
            </span>
            @php
            $__f26 = ['name' => 'cst_ipi_padrao', 'list' => $listaCST_IPI, 'selected' => $business->cst_ipi_padrao, 'options' => ['class' => 'form-control', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
            @endphp
            <x-form.select :name="$__f26['name']" :list="$__f26['list']" :selected="$__f26['selected']" :options="$__f26['options']" />
        </div>
    </div>
</div>

<div class="col-sm-3">
    <div class="form-group">
        @php
        $__f27 = ['name' => 'perc_icms_padrao', 'value' => '%ICMS Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
        <div class="">
           @php
           $__f28 = ['name' => 'perc_icms_padrao', 'value' => $business->perc_icms_padrao, 'options' => ['class' => 'form-control text-uppercase', 'data-mask="00.00"', 'data-mask-reverse="true"']];
           @endphp
           <x-form.input type="text" :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
       </div>
   </div>
</div>

<div class="col-sm-3">
    <div class="form-group">
        @php
        $__f29 = ['name' => 'perc_pis_padrao', 'value' => '%PIS Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
        <div class="">
           @php
           $__f30 = ['name' => 'perc_pis_padrao', 'value' => $business->perc_pis_padrao, 'options' => ['class' => 'form-control text-uppercase', 'data-mask="00.00"', 'data-mask-reverse="true"']];
           @endphp
           <x-form.input type="text" :name="$__f30['name']" :value="$__f30['value']" :options="$__f30['options']" />

       </div>
   </div>
</div>

<div class="col-sm-3">
    <div class="form-group">
        @php
        $__f31 = ['name' => 'perc_cofins_padrao', 'value' => '%COFINS Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f31['name']" :value="$__f31['value']" />
        <div class="">
           @php
           $__f32 = ['name' => 'perc_cofins_padrao', 'value' => $business->perc_cofins_padrao, 'options' => ['class' => 'form-control text-uppercase', 'data-mask="00.00"', 'data-mask-reverse="true"']];
           @endphp
           <x-form.input type="text" :name="$__f32['name']" :value="$__f32['value']" :options="$__f32['options']" />

       </div>
   </div>
</div>

<div class="col-sm-3">
    <div class="form-group">
        @php
        $__f33 = ['name' => 'perc_ipi_padrao', 'value' => '%IPI Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f33['name']" :value="$__f33['value']" />
        <div class="">
           @php
           $__f34 = ['name' => 'perc_ipi_padrao', 'value' => $business->perc_ipi_padrao, 'options' => ['class' => 'form-control text-uppercase', 'data-mask="00.00"', 'data-mask-reverse="true"']];
           @endphp
           <x-form.input type="text" :name="$__f34['name']" :value="$__f34['value']" :options="$__f34['options']" />

       </div>
   </div>
</div>

<div class="col-sm-3">
    <div class="form-group">
        @php
        $__f35 = ['name' => 'ncm_padrao', 'value' => 'NCM Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f35['name']" :value="$__f35['value']" />
        <div class="">
           @php
           $__f36 = ['name' => 'ncm_padrao', 'value' => $business->ncm_padrao, 'options' => ['class' => 'form-control text-uppercase', 'data-mask="0000.00.00"']];
           @endphp
           <x-form.input type="text" :name="$__f36['name']" :value="$__f36['value']" :options="$__f36['options']" />

       </div>
   </div>
</div>

<div class="col-sm-3">
    <div class="form-group">
        @php
        $__f37 = ['name' => 'cfop_saida_estadual_padrao', 'value' => 'CFOP saida estadual Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f37['name']" :value="$__f37['value']" />
        <div class="">
           @php
           $__f38 = ['name' => 'cfop_saida_estadual_padrao', 'value' => $business->cfop_saida_estadual_padrao, 'options' => ['class' => 'form-control text-uppercase', 'data-mask="0000"']];
           @endphp
           <x-form.input type="text" :name="$__f38['name']" :value="$__f38['value']" :options="$__f38['options']" />

       </div>
   </div>
</div>

<div class="col-sm-3">
    <div class="form-group">
        @php
        $__f39 = ['name' => 'cfop_saida_inter_estadual_padrao', 'value' => 'CFOP saida inter estadual Padrão' . ':*'];
        @endphp
        <x-form.label :name="$__f39['name']" :value="$__f39['value']" />
        <div class="">
           @php
           $__f40 = ['name' => 'cfop_saida_inter_estadual_padrao', 'value' => $business->cfop_saida_inter_estadual_padrao, 'options' => ['class' => 'form-control text-uppercase', 'data-mask="0000"']];
           @endphp
           <x-form.input type="text" :name="$__f40['name']" :value="$__f40['value']" :options="$__f40['options']" />

       </div>
   </div>
</div>


</div>
</div>