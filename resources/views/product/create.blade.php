@extends('layouts.app')
@section('title', __('product.add_new_product'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>@lang('product.add_new_product')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      @php
      $form_class = empty($duplicate_product) ? 'create' : '';
      @endphp
      @php
      $__f1 = ['options' => ['url' => action('ProductController@store'), 'method' => 'post', 'id' => 'product_add_form','class' => 'product_form ' . $form_class, 'files' => true ]];
      @endphp
      <x-form.open :options="$__f1['options']" />
      @component('components.widget', ['class' => 'box-primary'])
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f2 = ['name' => 'name', 'value' => __('product.product_name') . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
            @php
            $__f3 = ['name' => 'name', 'value' => !empty($duplicate_product->name) ? $duplicate_product->name : null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('product.product_name')]];
            @endphp
            <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'sku', 'value' => __('product.sku') . ':'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" /> @show_tooltip(__('tooltip.sku'))
            @php
            $__f5 = ['name' => 'sku', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('product.sku')]];
            @endphp
            <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f6 = ['name' => 'barcode_type', 'value' => __('product.barcode_type') . ':*'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
            @php
            $__f7 = ['name' => 'barcode_type', 'list' => $barcode_types, 'selected' => !empty($duplicate_product->barcode_type) ? $duplicate_product->barcode_type : $barcode_default, 'options' => ['class' => 'form-control select2', 'required']];
            @endphp
            <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
          </div>
        </div>

        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f8 = ['name' => 'codigo_barras', 'value' => 'Código de barras' . ':'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
            @php
            $__f9 = ['name' => 'codigo_barras', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Código de barras']];
            @endphp
            <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
          </div>
        </div>

        <!-- <div class="clearfix"></div> -->
        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f10 = ['name' => 'unit_id', 'value' => __('product.unit') . ':*'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
            <div class="input-group">
              @php
              $__f11 = ['name' => 'unit_id', 'list' => $units, 'selected' => !empty($duplicate_product->unit_id) ? $duplicate_product->unit_id : session('business.default_unit'), 'options' => ['class' => 'form-control select2', 'required']];
              @endphp
              <x-form.select :name="$__f11['name']" :list="$__f11['list']" :selected="$__f11['selected']" :options="$__f11['options']" />
              <span class="input-group-btn">
                <button type="button" @if(!auth()->user()->can('unit.create')) disabled @endif class="btn btn-default bg-white btn-flat btn-modal" data-href="{{action('UnitController@create', ['quick_add' => true])}}" title="@lang('unit.add_unit')" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
              </span>
            </div>
          </div>
        </div>

        <div class="col-sm-4 @if(!session('business.enable_sub_units')) hide @endif">
          <div class="form-group">
            @php
            $__f12 = ['name' => 'sub_unit_ids', 'value' => __('lang_v1.related_sub_units') . ':'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" /> @show_tooltip(__('lang_v1.sub_units_tooltip'))

            @php
            $__f13 = ['name' => 'sub_unit_ids[]', 'list' => [], 'selected' => !empty($duplicate_product->sub_unit_ids) ? $duplicate_product->sub_unit_ids : null, 'options' => ['class' => 'form-control select2', 'multiple', 'id' => 'sub_unit_ids']];
            @endphp
            <x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
          </div>
        </div>

        <div class="col-sm-4 @if(!session('business.enable_brand')) hide @endif">
          <div class="form-group">
            @php
            $__f14 = ['name' => 'brand_id', 'value' => __('product.brand') . ':'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
            <div class="input-group">
              @php
              $__f15 = ['name' => 'brand_id', 'list' => $brands, 'selected' => !empty($duplicate_product->brand_id) ? $duplicate_product->brand_id : null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']];
              @endphp
              <x-form.select :name="$__f15['name']" :list="$__f15['list']" :selected="$__f15['selected']" :options="$__f15['options']" />
              <span class="input-group-btn">
                <button type="button" @if(!auth()->user()->can('brand.create')) disabled @endif class="btn btn-default bg-white btn-flat btn-modal" data-href="{{action('BrandController@create', ['quick_add' => true])}}" title="@lang('brand.add_brand')" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
              </span>
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-4 @if(!session('business.enable_category')) hide @endif">
          <div class="form-group">
            @php
            $__f16 = ['name' => 'category_id', 'value' => __('product.category') . ':'];
            @endphp
            <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
            @php
            $__f17 = ['name' => 'category_id', 'list' => $categories, 'selected' => !empty($duplicate_product->category_id) ? $duplicate_product->category_id : null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']];
            @endphp
            <x-form.select :name="$__f17['name']" :list="$__f17['list']" :selected="$__f17['selected']" :options="$__f17['options']" />
          </div>
        </div>

        <div class="col-sm-4 @if(!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
          <div class="form-group">
            @php
            $__f18 = ['name' => 'sub_category_id', 'value' => __('product.sub_category') . ':'];
            @endphp
            <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
            @php
            $__f19 = ['name' => 'sub_category_id', 'list' => $sub_categories, 'selected' => !empty($duplicate_product->sub_category_id) ? $duplicate_product->sub_category_id : null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']];
            @endphp
            <x-form.select :name="$__f19['name']" :list="$__f19['list']" :selected="$__f19['selected']" :options="$__f19['options']" />
          </div>
        </div>

        @php
        $default_location = null;
        if(count($business_locations) == 1){
          $default_location = array_key_first($business_locations->toArray());
        }
        @endphp
        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f20 = ['name' => 'product_locations', 'value' => __('business.business_locations') . ':'];
            @endphp
            <x-form.label :name="$__f20['name']" :value="$__f20['value']" /> @show_tooltip(__('lang_v1.product_location_help'))
            @php
            $__f21 = ['name' => 'product_locations[]', 'list' => $business_locations, 'selected' => $default_location, 'options' => ['class' => 'form-control select2', 'multiple', 'id' => 'product_locations']];
            @endphp
            <x-form.select :name="$__f21['name']" :list="$__f21['list']" :selected="$__f21['selected']" :options="$__f21['options']" />
          </div>
        </div>


        <div class="clearfix"></div>

        <div class="col-sm-4">
          <div class="form-group">
            <br>
            <label>
              @php
              $__f22 = ['name' => 'enable_stock', 'value' => 1, 'checked' => !empty($duplicate_product) ? $duplicate_product->enable_stock : true, 'options' => ['class' => 'input-icheck', 'id' => 'enable_stock']];
              @endphp
              <x-form.checkbox :name="$__f22['name']" :value="$__f22['value']" :checked="$__f22['checked']" :options="$__f22['options']" /> <strong>@lang('product.manage_stock')</strong>
            </label>@show_tooltip(__('tooltip.enable_stock')) <p class="help-block"><i>@lang('product.enable_stock_help')</i></p>
          </div>
        </div>
        <div class="col-sm-4 @if(!empty($duplicate_product) && $duplicate_product->enable_stock == 0) hide @endif" id="alert_quantity_div">
          <div class="form-group">
            @php
            $__f23 = ['name' => 'alert_quantity', 'value' => __('product.alert_quantity') . ':'];
            @endphp
            <x-form.label :name="$__f23['name']" :value="$__f23['value']" /> @show_tooltip(__('tooltip.alert_quantity'))
            @php
            $__f24 = ['name' => 'alert_quantity', 'value' => !empty($duplicate_product->alert_quantity) ? $duplicate_product->alert_quantity : null, 'options' => ['class' => 'form-control', 'placeholder' => __('product.alert_quantity'), 'min' => '0']];
            @endphp
            <x-form.input type="number" :name="$__f24['name']" :value="$__f24['value']" :options="$__f24['options']" />
          </div>
        </div>
        @if(!empty($common_settings['enable_product_warranty']))
        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f25 = ['name' => 'warranty_id', 'value' => __('lang_v1.warranty') . ':'];
            @endphp
            <x-form.label :name="$__f25['name']" :value="$__f25['value']" />
            @php
            $__f26 = ['name' => 'warranty_id', 'list' => $warranties, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]];
            @endphp
            <x-form.select :name="$__f26['name']" :list="$__f26['list']" :selected="$__f26['selected']" :options="$__f26['options']" />
          </div>
        </div>
        @endif
        <!-- include module fields -->
        @if(!empty($pos_module_data))
        @foreach($pos_module_data as $key => $value)
        @if(!empty($value['view_path']))
        @includeIf($value['view_path'], ['view_data' => $value['view_data']])
        @endif
        @endforeach
        @endif
        <div class="clearfix"></div>
        <div class="col-sm-8">
          <div class="form-group">
            @php
            $__f27 = ['name' => 'product_description', 'value' => __('lang_v1.product_description') . ':'];
            @endphp
            <x-form.label :name="$__f27['name']" :value="$__f27['value']" />
            @php
            $__f28 = ['name' => 'product_description', 'value' => !empty($duplicate_product->product_description) ? $duplicate_product->product_description : null, 'options' => ['class' => 'form-control']];
            @endphp
            <x-form.textarea :name="$__f28['name']" :value="$__f28['value']" :options="$__f28['options']" />
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            @php
            $__f29 = ['name' => 'image', 'value' => __('lang_v1.product_image') . ':'];
            @endphp
            <x-form.label :name="$__f29['name']" :value="$__f29['value']" />
            @php
            $__f30 = ['name' => 'image', 'options' => ['id' => 'upload_image', 'accept' => 'image/*']];
            @endphp
            <x-form.input type="file" :name="$__f30['name']" :options="$__f30['options']" />
            <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) <br> @lang('lang_v1.aspect_ratio_should_be_1_1')</p></small>
          </div>
        </div>
      </div>
      @endcomponent

      @if (in_array('ecommerce', $enabled_modules) && auth()->user()->can('ecommerce.view'))
        <div class="box @if(!empty($class)) {{$class}} @else box-primary @endif" id="accordion">
          <div class="box-header with-border" style="cursor: pointer;">
            <h3 class="box-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                Ecommerce
              </a>
            </h3>
          </div>
          <div id="collapseFilter" class="panel-collapse active collapse" aria-expanded="true">
            <div class="box-body">
              <div class="row">
                <div class="col-sm-2">
                  <div class="form-group">
                    <br>
                    <label>
                      @php
                      $__f31 = ['name' => 'ecommerce', 'value' => 1, 'checked' => !(empty($duplicate_product)) ? $duplicate_product->ecommerce : false, 'options' => ['class' => 'input-icheck']];
                      @endphp
                      <x-form.checkbox :name="$__f31['name']" :value="$__f31['value']" :checked="$__f31['checked']" :options="$__f31['options']" /> <strong>Ecommerce</strong>
                    </label> @show_tooltip('Se marcado, o produto será visível no ecommerce')
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="form-group">
                    <br>
                    <label>
                      @php
                      $__f32 = ['name' => 'destaque', 'value' => 1, 'checked' => !(empty($duplicate_product)) ? $duplicate_product->destaque : false, 'options' => ['class' => 'input-icheck']];
                      @endphp
                      <x-form.checkbox :name="$__f32['name']" :value="$__f32['value']" :checked="$__f32['checked']" :options="$__f32['options']" /> <strong>Destaque</strong>
                    </label> @show_tooltip('Se marcado, o produto será mostrado na primeira pagina')
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="form-group">
                    <br>
                    <label>
                      @php
                      $__f33 = ['name' => 'novo', 'value' => 1, 'checked' => !(empty($duplicate_product)) ? $duplicate_product->novo : false, 'options' => ['class' => 'input-icheck']];
                      @endphp
                      <x-form.checkbox :name="$__f33['name']" :value="$__f33['value']" :checked="$__f33['checked']" :options="$__f33['options']" /> <strong>Novo</strong>
                    </label> @show_tooltip('Se marcado, o produto será mostrado como novidade')
                  </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-2">
                  <div class="form-group">
                    @php
                    $__f34 = ['name' => 'weight', 'value' => __('lang_v1.weight') . ':'];
                    @endphp
                    <x-form.label :name="$__f34['name']" :value="$__f34['value']" />
                    @php
                    $__f35 = ['name' => 'weight', 'value' => !empty($duplicate_product->weight) ? $duplicate_product->weight : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.weight'), 'data-mask="000000.000"', 'data-mask-reverse="true"']];
                    @endphp
                    <x-form.input type="text" :name="$__f35['name']" :value="$__f35['value']" :options="$__f35['options']" />
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="form-group">
                    @php
                    $__f36 = ['name' => 'altura', 'value' => 'Altura' . ':'];
                    @endphp
                    <x-form.label :name="$__f36['name']" :value="$__f36['value']" />
                    @php
                    $__f37 = ['name' => 'altura', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Altura', 'data-mask="000000,00"', 'data-mask-reverse="true"']];
                    @endphp
                    <x-form.input type="text" :name="$__f37['name']" :value="$__f37['value']" :options="$__f37['options']" />
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="form-group">
                    @php
                    $__f38 = ['name' => 'largura', 'value' => 'Largura' . ':'];
                    @endphp
                    <x-form.label :name="$__f38['name']" :value="$__f38['value']" />
                    @php
                    $__f39 = ['name' => 'largura', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Largura', 'data-mask="000000,00"', 'data-mask-reverse="true"']];
                    @endphp
                    <x-form.input type="text" :name="$__f39['name']" :value="$__f39['value']" :options="$__f39['options']" />
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="form-group">
                    @php
                    $__f40 = ['name' => 'comprimento', 'value' => 'Comprimento' . ':'];
                    @endphp
                    <x-form.label :name="$__f40['name']" :value="$__f40['value']" />
                    @php
                    $__f41 = ['name' => 'comprimento', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Comprimento', 'data-mask="000000,00"', 'data-mask-reverse="true"']];
                    @endphp
                    <x-form.input type="text" :name="$__f41['name']" :value="$__f41['value']" :options="$__f41['options']" />
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="form-group">
                    @php
                    $__f42 = ['name' => 'valor_ecommerce', 'value' => 'Valor ecommerce' . ':'];
                    @endphp
                    <x-form.label :name="$__f42['name']" :value="$__f42['value']" />
                    @php
                    $__f43 = ['name' => 'valor_ecommerce', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => 'Valor ecommerce', 'data-mask="000000,00"', 'data-mask-reverse="true"']];
                    @endphp
                    <x-form.input type="text" :name="$__f43['name']" :value="$__f43['value']" :options="$__f43['options']" />
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        @endif

        @component('components.widget', ['class' => 'box-primary'])
        <div class="row">
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
                $__f44 = ['name' => 'expiry_period', 'value' => __('product.expires_in') . ':'];
                @endphp
                <x-form.label :name="$__f44['name']" :value="$__f44['value']" /><br>
                @php
                $__f45 = ['name' => 'expiry_period', 'value' => !empty($duplicate_product->expiry_period) ? number_format($duplicate_product->expiry_period, 2, ',', '.') : $expiry_period, 'options' => ['class' => 'form-control pull-left input_number', 'placeholder' => __('product.expiry_period'), 'style' => 'width:60%;']];
                @endphp
                <x-form.input type="text" :name="$__f45['name']" :value="$__f45['value']" :options="$__f45['options']" />
                @php
                $__f46 = ['name' => 'expiry_period_type', 'list' => ['months'=>__('product.months'), 'days'=>__('product.days'), '' =>__('product.not_applicable') ], 'selected' => !empty($duplicate_product->expiry_period_type) ? $duplicate_product->expiry_period_type : 'months', 'options' => ['class' => 'form-control select2 pull-left', 'style' => 'width:40%;', 'id' => 'expiry_period_type']];
                @endphp
                <x-form.select :name="$__f46['name']" :list="$__f46['list']" :selected="$__f46['selected']" :options="$__f46['options']" />
              </div>
            </div>
          </div>
          @endif

          <div class="col-sm-4">
            <div class="form-group">
              <br>
              <label>
                @php
                $__f47 = ['name' => 'enable_sr_no', 'value' => 1, 'checked' => !(empty($duplicate_product)) ? $duplicate_product->enable_sr_no : false, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f47['name']" :value="$__f47['value']" :checked="$__f47['checked']" :options="$__f47['options']" /> <strong>@lang('lang_v1.enable_imei_or_sr_no')</strong>
              </label> @show_tooltip(__('lang_v1.tooltip_sr_no'))
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <br>
              <label>
                @php
                $__f48 = ['name' => 'not_for_selling', 'value' => 1, 'checked' => !(empty($duplicate_product)) ? $duplicate_product->not_for_selling : false, 'options' => ['class' => 'input-icheck']];
                @endphp
                <x-form.checkbox :name="$__f48['name']" :value="$__f48['value']" :checked="$__f48['checked']" :options="$__f48['options']" /> <strong>@lang('lang_v1.not_for_selling')</strong>
              </label> @show_tooltip(__('lang_v1.tooltip_not_for_selling'))
            </div>
          </div>



          <!-- Rack, Row & position number -->
          @if(session('business.enable_racks') || session('business.enable_row') || session('business.enable_position'))
          <div class="col-md-12">
            <h4>@lang('lang_v1.rack_details'):
              @show_tooltip(__('lang_v1.tooltip_rack_details'))
            </h4>
          </div>
          @foreach($business_locations as $id => $location)
          <div class="col-sm-3">
            <div class="form-group">
              @php
              $__f49 = ['name' => 'rack_' . $id, 'value' => $location . ':'];
              @endphp
              <x-form.label :name="$__f49['name']" :value="$__f49['value']" />

              @if(session('business.enable_racks'))
              @php
              $__f50 = ['name' => 'product_racks[' . $id . '][rack]', 'value' => !empty($rack_details[$id]['rack']) ? $rack_details[$id]['rack'] : null, 'options' => ['class' => 'form-control', 'id' => 'rack_' . $id, 'placeholder' => __('lang_v1.rack')]];
              @endphp
              <x-form.input type="text" :name="$__f50['name']" :value="$__f50['value']" :options="$__f50['options']" />
              @endif

              @if(session('business.enable_row'))
              @php
              $__f51 = ['name' => 'product_racks[' . $id . '][row]', 'value' => !empty($rack_details[$id]['row']) ? $rack_details[$id]['row'] : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.row')]];
              @endphp
              <x-form.input type="text" :name="$__f51['name']" :value="$__f51['value']" :options="$__f51['options']" />
              @endif

              @if(session('business.enable_position'))
              @php
              $__f52 = ['name' => 'product_racks[' . $id . '][position]', 'value' => !empty($rack_details[$id]['position']) ? $rack_details[$id]['position'] : null, 'options' => ['class' => 'form-control', 'placeholder' => __('lang_v1.position')]];
              @endphp
              <x-form.input type="text" :name="$__f52['name']" :value="$__f52['value']" :options="$__f52['options']" />
              @endif
            </div>
          </div>
          @endforeach
          @endif


          @php
          $custom_labels = json_decode(session('business.custom_labels'), true);
          $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
          $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
          $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
          $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
          @endphp
          <!--custom fields-->
          <div class="clearfix"></div>
          <div class="col-sm-3">
            <div class="form-group">
              @php
              $__f53 = ['name' => 'product_custom_field1', 'value' => $product_custom_field1 . ':'];
              @endphp
              <x-form.label :name="$__f53['name']" :value="$__f53['value']" />
              @php
              $__f54 = ['name' => 'product_custom_field1', 'value' => !empty($duplicate_product->product_custom_field1) ? $duplicate_product->product_custom_field1 : null, 'options' => ['class' => 'form-control', 'placeholder' => $product_custom_field1]];
              @endphp
              <x-form.input type="text" :name="$__f54['name']" :value="$__f54['value']" :options="$__f54['options']" />
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              @php
              $__f55 = ['name' => 'product_custom_field2', 'value' => $product_custom_field2 . ':'];
              @endphp
              <x-form.label :name="$__f55['name']" :value="$__f55['value']" />
              @php
              $__f56 = ['name' => 'product_custom_field2', 'value' => !empty($duplicate_product->product_custom_field2) ? $duplicate_product->product_custom_field2 : null, 'options' => ['class' => 'form-control', 'placeholder' => $product_custom_field2]];
              @endphp
              <x-form.input type="text" :name="$__f56['name']" :value="$__f56['value']" :options="$__f56['options']" />
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              @php
              $__f57 = ['name' => 'product_custom_field3', 'value' => $product_custom_field3 . ':'];
              @endphp
              <x-form.label :name="$__f57['name']" :value="$__f57['value']" />
              @php
              $__f58 = ['name' => 'product_custom_field3', 'value' => !empty($duplicate_product->product_custom_field3) ? $duplicate_product->product_custom_field3 : null, 'options' => ['class' => 'form-control', 'placeholder' => $product_custom_field3]];
              @endphp
              <x-form.input type="text" :name="$__f58['name']" :value="$__f58['value']" :options="$__f58['options']" />
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              @php
              $__f59 = ['name' => 'product_custom_field4', 'value' => $product_custom_field4 . ':'];
              @endphp
              <x-form.label :name="$__f59['name']" :value="$__f59['value']" />
              @php
              $__f60 = ['name' => 'product_custom_field4', 'value' => !empty($duplicate_product->product_custom_field4) ? $duplicate_product->product_custom_field4 : null, 'options' => ['class' => 'form-control', 'placeholder' => $product_custom_field4]];
              @endphp
              <x-form.input type="text" :name="$__f60['name']" :value="$__f60['value']" :options="$__f60['options']" />
            </div>
          </div>
          <!--custom fields-->
          <div class="clearfix"></div>
          @include('layouts.partials.module_form_part')
        </div>
        @endcomponent


        @component('components.widget', ['class' => 'box-primary'])
        <div class="row">

          <div class="col-sm-4 @if(!session('business.enable_price_tax')) hide @endif">
            <div class="form-group">
              @php
              $__f61 = ['name' => 'tax', 'value' => __('product.applicable_tax') . ':'];
              @endphp
              <x-form.label :name="$__f61['name']" :value="$__f61['value']" />
              @php
              $__f62 = ['name' => 'tax', 'list' => $taxes, 'selected' => !empty($duplicate_product->tax) ? $duplicate_product->tax : null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2'], 'optionsAttributes' => $tax_attributes];
              @endphp
              <x-form.select :name="$__f62['name']" :list="$__f62['list']" :selected="$__f62['selected']" :options="$__f62['options']" :options-attributes="$__f62['optionsAttributes']" />
            </div>
          </div>

          <div class="col-sm-4 @if(!session('business.enable_price_tax')) hide @endif">
            <div class="form-group">
              @php
              $__f63 = ['name' => 'tax_type', 'value' => __('product.selling_price_tax_type') . ':*'];
              @endphp
              <x-form.label :name="$__f63['name']" :value="$__f63['value']" />
              @php
              $__f64 = ['name' => 'tax_type', 'list' => ['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], 'selected' => !empty($duplicate_product->tax_type) ? $duplicate_product->tax_type : 'exclusive', 'options' => ['class' => 'form-control select2', 'required']];
              @endphp
              <x-form.select :name="$__f64['name']" :list="$__f64['list']" :selected="$__f64['selected']" :options="$__f64['options']" />
            </div>
          </div>

          <div class="col-sm-4" style="visibility: hidden;">
            <div class="form-group">
              @php
              $__f65 = ['name' => 'unidade_venda', 'value' => 'Unidade de Venda' . ':*'];
              @endphp
              <x-form.label :name="$__f65['name']" :value="$__f65['value']" />
              @php
              $__f66 = ['name' => 'unidade_venda', 'list' => $unidadesDeMedida, 'selected' => null, 'options' => ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
              @endphp
              <x-form.select :name="$__f66['name']" :list="$__f66['list']" :selected="$__f66['selected']" :options="$__f66['options']" />
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="col-sm-4">
            <div class="form-group">
              @php
              $__f67 = ['name' => 'type', 'value' => __('product.product_type') . ':*'];
              @endphp
              <x-form.label :name="$__f67['name']" :value="$__f67['value']" /> @show_tooltip(__('tooltip.product_type'))
              @php
              $__f68 = ['name' => 'type', 'list' => $product_types, 'selected' => !empty($duplicate_product->type) ? $duplicate_product->type : null, 'options' => ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
              @endphp
              <x-form.select :name="$__f68['name']" :list="$__f68['list']" :selected="$__f68['selected']" :options="$__f68['options']" />
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              <label for="product_custom_field2">%ICMS:</label>
              <input required value="{{$business->perc_icms_padrao}}" class="form-control" placeholder="%ICMS" data-mask="00.00" name="perc_icms" data-mask-reverse="true" type="text" id="perc_icms">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="product_custom_field2">%PIS:</label>
              <input required value="{{$business->perc_pis_padrao}}" class="form-control" placeholder="%PIS" data-mask="00.00" name="perc_pis" data-mask-reverse="true" type="text" id="perc_pis">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="product_custom_field2">%COFINS:</label>
              <input required value="{{$business->perc_cofins_padrao}}" class="form-control" placeholder="%COFINS" data-mask="00.00" data-mask-reverse="true" name="perc_cofins" type="text" id="perc_cofins">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="product_custom_field2">%IPI:</label>
              <input required value="{{$business->perc_ipi_padrao}}" class="form-control" placeholder="%IPI" data-mask="00.00" data-mask-reverse="true" name="perc_ipi" type="text" id="perc_ipi">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              @php
              $__f69 = ['name' => 'cst_csosn', 'value' => 'CST/CSOSN' . ':*'];
              @endphp
              <x-form.label :name="$__f69['name']" :value="$__f69['value']" />
              @php
              $__f70 = ['name' => 'cst_csosn', 'list' => $listaCSTCSOSN, 'selected' => $business->cst_csosn_padrao, 'options' => ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
              @endphp
              <x-form.select :name="$__f70['name']" :list="$__f70['list']" :selected="$__f70['selected']" :options="$__f70['options']" />
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              @php
              $__f71 = ['name' => 'cst_pis', 'value' => 'CST/PIS' . ':*'];
              @endphp
              <x-form.label :name="$__f71['name']" :value="$__f71['value']" /> 
              @php
              $__f72 = ['name' => 'cst_pis', 'list' => $listaCST_PIS_COFINS, 'selected' => $business->cst_pis_padrao, 'options' => ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
              @endphp
              <x-form.select :name="$__f72['name']" :list="$__f72['list']" :selected="$__f72['selected']" :options="$__f72['options']" />
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              @php
              $__f73 = ['name' => 'cst_cofins', 'value' => 'CST/COFINS' . ':*'];
              @endphp
              <x-form.label :name="$__f73['name']" :value="$__f73['value']" /> 
              @php
              $__f74 = ['name' => 'cst_cofins', 'list' => $listaCST_PIS_COFINS, 'selected' => $business->cst_cofins_padrao, 'options' => ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
              @endphp
              <x-form.select :name="$__f74['name']" :list="$__f74['list']" :selected="$__f74['selected']" :options="$__f74['options']" />
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              @php
              $__f75 = ['name' => 'cst_ipi', 'value' => 'CST/IPI' . ':*'];
              @endphp
              <x-form.label :name="$__f75['name']" :value="$__f75['value']" /> 
              @php
              $__f76 = ['name' => 'cst_ipi', 'list' => $listaCST_IPI, 'selected' => $business->cst_ipi_padrao, 'options' => ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']];
              @endphp
              <x-form.select :name="$__f76['name']" :list="$__f76['list']" :selected="$__f76['selected']" :options="$__f76['options']" />
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              <label for="product_custom_field2">CFOP Estadual*:</label>
              <input required value="{{$business->cfop_saida_estadual_padrao}}" required class="form-control" data-mask="0000" placeholder="CFOP Estadual" name="cfop_interno" type="number" id="cfop_interno">
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              <label for="product_custom_field2">CFOP Inter estadual*:</label>
              <input required value="{{$business->cfop_saida_inter_estadual_padrao}}" required class="form-control" data-mask="0000" placeholder="CFOP Inter estadual" name="cfop_externo" type="number" id="cfop_externo">
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              <label for="product_custom_field2">NCM*:</label>
              <input required value="{{$business->ncm_padrao}}" required class="form-control" data-mask="0000.00.00" placeholder="NCM" name="ncm" type="text" id="ncm">
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
              $__f77 = ['name' => 'origem', 'value' => 'Origem' . ':'];
              @endphp
              <x-form.label :name="$__f77['name']" :value="$__f77['value']" />
              @php
              $__f78 = ['name' => 'origem', 'list' => App\Models\Product::listaOrigem(), 'selected' => '', 'options' => ['class' => 'form-control select2']];
              @endphp
              <x-form.select :name="$__f78['name']" :list="$__f78['list']" :selected="$__f78['selected']" :options="$__f78['options']" />
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="col-sm-5">
            <div class="form-group">
              @php
              $__f79 = ['name' => 'codigo_anp', 'value' => 'ANP' . ':'];
              @endphp
              <x-form.label :name="$__f79['name']" :value="$__f79['value']" />
              @php
              $__f80 = ['name' => 'codigo_anp', 'list' => App\Models\Product::lista_ANP(), 'selected' => '', 'options' => ['class' => 'form-control select2']];
              @endphp
              <x-form.select :name="$__f80['name']" :list="$__f80['list']" :selected="$__f80['selected']" :options="$__f80['options']" />
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              @php
              $__f81 = ['name' => 'perc_glp', 'value' => '% GLP' . ':'];
              @endphp
              <x-form.label :name="$__f81['name']" :value="$__f81['value']" />
              @php
              $__f82 = ['name' => 'perc_glp', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => '% GLP', 'data-mask="000.00"', 'data-mask-reverse="true"']];
              @endphp
              <x-form.input type="text" :name="$__f82['name']" :value="$__f82['value']" :options="$__f82['options']" />
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              @php
              $__f83 = ['name' => 'perc_gnn', 'value' => '% GNn' . ':'];
              @endphp
              <x-form.label :name="$__f83['name']" :value="$__f83['value']" />
              @php
              $__f84 = ['name' => 'perc_gnn', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => '% GNn', 'data-mask="000.00"', 'data-mask-reverse="true"']];
              @endphp
              <x-form.input type="text" :name="$__f84['name']" :value="$__f84['value']" :options="$__f84['options']" />
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              @php
              $__f85 = ['name' => 'perc_gni', 'value' => '% GNi' . ':'];
              @endphp
              <x-form.label :name="$__f85['name']" :value="$__f85['value']" />
              @php
              $__f86 = ['name' => 'perc_gni', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => '% GNi', 'data-mask="000.00"', 'data-mask-reverse="true"']];
              @endphp
              <x-form.input type="text" :name="$__f86['name']" :value="$__f86['value']" :options="$__f86['options']" />
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              @php
              $__f87 = ['name' => 'valor_partida', 'value' => 'Valor partida' . ':'];
              @endphp
              <x-form.label :name="$__f87['name']" :value="$__f87['value']" />
              @php
              $__f88 = ['name' => 'valor_partida', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Valor partida', 'data-mask="000000.00"', 'data-mask-reverse="true"']];
              @endphp
              <x-form.input type="text" :name="$__f88['name']" :value="$__f88['value']" :options="$__f88['options']" />
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              @php
              $__f89 = ['name' => 'unidade_tributavel', 'value' => 'Un. tributável' . ':'];
              @endphp
              <x-form.label :name="$__f89['name']" :value="$__f89['value']" />
              @php
              $__f90 = ['name' => 'unidade_tributavel', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Un. tributável', 'data-mask="AAAA"', 'data-mask-reverse="true"']];
              @endphp
              <x-form.input type="text" :name="$__f90['name']" :value="$__f90['value']" :options="$__f90['options']" />
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              @php
              $__f91 = ['name' => 'quantidade_tributavel', 'value' => 'Qtd. tributável' . ':'];
              @endphp
              <x-form.label :name="$__f91['name']" :value="$__f91['value']" />
              @php
              $__f92 = ['name' => 'quantidade_tributavel', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Qtd. tributável']];
              @endphp
              <x-form.input type="text" :name="$__f92['name']" :value="$__f92['value']" :options="$__f92['options']" />
            </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
              @php
              $__f93 = ['name' => 'tipo', 'value' => 'Tipo' . ':'];
              @endphp
              <x-form.label :name="$__f93['name']" :value="$__f93['value']" />
              @php
              $__f94 = ['name' => 'tipo', 'list' => ['normal' => 'Normal', 'veiculo' => 'Veiculo'], 'selected' => '', 'options' => ['class' => 'form-control select2']];
              @endphp
              <x-form.select :name="$__f94['name']" :list="$__f94['list']" :selected="$__f94['selected']" :options="$__f94['options']" />
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="veiculo" style="display: none">
            @component('components.widget', ['class' => 'box-danger'])
            <div class="col-sm-12">
              <h4>Dados Veículo:</h4>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                @php
                $__f95 = ['name' => 'veicProd', 'value' => 'Detalhamento de Veículo' . ':'];
                @endphp
                <x-form.label :name="$__f95['name']" :value="$__f95['value']" />
                @php
                $__f96 = ['name' => 'veicProd', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Detalhamento de Veículo']];
                @endphp
                <x-form.input type="text" :name="$__f96['name']" :value="$__f96['value']" :options="$__f96['options']" />
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                @php
                $__f97 = ['name' => 'tpOp', 'value' => 'Tipo da operação' . ':'];
                @endphp
                <x-form.label :name="$__f97['name']" :value="$__f97['value']" />
                @php
                $__f98 = ['name' => 'tpOp', 'list' => App\Models\Veiculo::tiposOperacao(), 'selected' => '', 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%']];
                @endphp
                <x-form.select :name="$__f98['name']" :list="$__f98['list']" :selected="$__f98['selected']" :options="$__f98['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f99 = ['name' => 'chassi', 'value' => 'Chassi' . ':'];
                @endphp
                <x-form.label :name="$__f99['name']" :value="$__f99['value']" />
                @php
                $__f100 = ['name' => 'chassi', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Chassi']];
                @endphp
                <x-form.input type="text" :name="$__f100['name']" :value="$__f100['value']" :options="$__f100['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f101 = ['name' => 'cCor', 'value' => 'Código da cor' . ':'];
                @endphp
                <x-form.label :name="$__f101['name']" :value="$__f101['value']" />
                @php
                $__f102 = ['name' => 'cCor', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Código da cor']];
                @endphp
                <x-form.input type="text" :name="$__f102['name']" :value="$__f102['value']" :options="$__f102['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f103 = ['name' => 'xCor', 'value' => 'Descrição da cor' . ':'];
                @endphp
                <x-form.label :name="$__f103['name']" :value="$__f103['value']" />
                @php
                $__f104 = ['name' => 'xCor', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Descrição da cor']];
                @endphp
                <x-form.input type="text" :name="$__f104['name']" :value="$__f104['value']" :options="$__f104['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f105 = ['name' => 'pot', 'value' => 'Potência Motor (CV)' . ':'];
                @endphp
                <x-form.label :name="$__f105['name']" :value="$__f105['value']" />
                @php
                $__f106 = ['name' => 'pot', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Potência Motor (CV)']];
                @endphp
                <x-form.input type="text" :name="$__f106['name']" :value="$__f106['value']" :options="$__f106['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f107 = ['name' => 'cilin', 'value' => 'Cilindradas' . ':'];
                @endphp
                <x-form.label :name="$__f107['name']" :value="$__f107['value']" />
                @php
                $__f108 = ['name' => 'cilin', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Cilindradas']];
                @endphp
                <x-form.input type="text" :name="$__f108['name']" :value="$__f108['value']" :options="$__f108['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f109 = ['name' => 'pesoL', 'value' => 'Peso líquido' . ':'];
                @endphp
                <x-form.label :name="$__f109['name']" :value="$__f109['value']" />
                @php
                $__f110 = ['name' => 'pesoL', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Peso líquido']];
                @endphp
                <x-form.input type="text" :name="$__f110['name']" :value="$__f110['value']" :options="$__f110['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f111 = ['name' => 'pesoB', 'value' => 'Peso bruto' . ':'];
                @endphp
                <x-form.label :name="$__f111['name']" :value="$__f111['value']" />
                @php
                $__f112 = ['name' => 'pesoB', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Peso bruto']];
                @endphp
                <x-form.input type="text" :name="$__f112['name']" :value="$__f112['value']" :options="$__f112['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f113 = ['name' => 'nSerie', 'value' => 'Nº série' . ':'];
                @endphp
                <x-form.label :name="$__f113['name']" :value="$__f113['value']" />
                @php
                $__f114 = ['name' => 'nSerie', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Nº série']];
                @endphp
                <x-form.input type="text" :name="$__f114['name']" :value="$__f114['value']" :options="$__f114['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f115 = ['name' => 'tpComb', 'value' => 'Tipo de combustível' . ':'];
                @endphp
                <x-form.label :name="$__f115['name']" :value="$__f115['value']" />
                @php
                $__f116 = ['name' => 'tpComb', 'list' => App\Models\Veiculo::tiposCompustivel(), 'selected' => '', 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%']];
                @endphp
                <x-form.select :name="$__f116['name']" :list="$__f116['list']" :selected="$__f116['selected']" :options="$__f116['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f117 = ['name' => 'nMotor', 'value' => 'Nº motor' . ':'];
                @endphp
                <x-form.label :name="$__f117['name']" :value="$__f117['value']" />
                @php
                $__f118 = ['name' => 'nMotor', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Nº série']];
                @endphp
                <x-form.input type="text" :name="$__f118['name']" :value="$__f118['value']" :options="$__f118['options']" />
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                @php
                $__f119 = ['name' => 'CMT', 'value' => 'Capacidade Máxima de Tração' . ':'];
                @endphp
                <x-form.label :name="$__f119['name']" :value="$__f119['value']" />
                @php
                $__f120 = ['name' => 'CMT', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Capacidade Máxima de Tração']];
                @endphp
                <x-form.input type="text" :name="$__f120['name']" :value="$__f120['value']" :options="$__f120['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f121 = ['name' => 'dist', 'value' => 'Distância entre eixos' . ':'];
                @endphp
                <x-form.label :name="$__f121['name']" :value="$__f121['value']" />
                @php
                $__f122 = ['name' => 'dist', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Distância entre eixos']];
                @endphp
                <x-form.input type="text" :name="$__f122['name']" :value="$__f122['value']" :options="$__f122['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f123 = ['name' => 'anoMod', 'value' => 'Ano Modelo de Fab' . ':'];
                @endphp
                <x-form.label :name="$__f123['name']" :value="$__f123['value']" />
                @php
                $__f124 = ['name' => 'anoMod', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Ano Modelo de Fabricação ']];
                @endphp
                <x-form.input type="text" :name="$__f124['name']" :value="$__f124['value']" :options="$__f124['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f125 = ['name' => 'anoFab', 'value' => 'Ano de Fabricação' . ':'];
                @endphp
                <x-form.label :name="$__f125['name']" :value="$__f125['value']" />
                @php
                $__f126 = ['name' => 'anoFab', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Ano de Fabricação ']];
                @endphp
                <x-form.input type="text" :name="$__f126['name']" :value="$__f126['value']" :options="$__f126['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f127 = ['name' => 'tpPint', 'value' => 'Tipo de pintura' . ':'];
                @endphp
                <x-form.label :name="$__f127['name']" :value="$__f127['value']" />
                @php
                $__f128 = ['name' => 'tpPint', 'list' => App\Models\Veiculo::tiposPintura(), 'selected' => '', 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%']];
                @endphp
                <x-form.select :name="$__f128['name']" :list="$__f128['list']" :selected="$__f128['selected']" :options="$__f128['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f129 = ['name' => 'tpVeic', 'value' => 'Tipo do veiculo' . ':'];
                @endphp
                <x-form.label :name="$__f129['name']" :value="$__f129['value']" />
                @php
                $__f130 = ['name' => 'tpVeic', 'list' => App\Models\Veiculo::tipos(), 'selected' => '', 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%']];
                @endphp
                <x-form.select :name="$__f130['name']" :list="$__f130['list']" :selected="$__f130['selected']" :options="$__f130['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f131 = ['name' => 'espVeic', 'value' => 'Espécie' . ':'];
                @endphp
                <x-form.label :name="$__f131['name']" :value="$__f131['value']" />
                @php
                $__f132 = ['name' => 'espVeic', 'list' => App\Models\Veiculo::especies(), 'selected' => '', 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%']];
                @endphp
                <x-form.select :name="$__f132['name']" :list="$__f132['list']" :selected="$__f132['selected']" :options="$__f132['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f133 = ['name' => 'VIN', 'value' => 'Condição do VIN' . ':'];
                @endphp
                <x-form.label :name="$__f133['name']" :value="$__f133['value']" />
                @php
                $__f134 = ['name' => 'VIN', 'list' => ['R' => 'Remarcado', 'N' => 'Normal'], 'selected' => '', 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%']];
                @endphp
                <x-form.select :name="$__f134['name']" :list="$__f134['list']" :selected="$__f134['selected']" :options="$__f134['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f135 = ['name' => 'condVeic', 'value' => 'Condição do Veículo' . ':'];
                @endphp
                <x-form.label :name="$__f135['name']" :value="$__f135['value']" />
                @php
                $__f136 = ['name' => 'condVeic', 'list' => ['1' => 'Acabado', '2' => 'Inacabado', '3' => 'Semiacabado'], 'selected' => '', 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%']];
                @endphp
                <x-form.select :name="$__f136['name']" :list="$__f136['list']" :selected="$__f136['selected']" :options="$__f136['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f137 = ['name' => 'cMod', 'value' => 'Código Marca Modelo' . ':'];
                @endphp
                <x-form.label :name="$__f137['name']" :value="$__f137['value']" />
                @php
                $__f138 = ['name' => 'cMod', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Código Marca Modelo']];
                @endphp
                <x-form.input type="text" :name="$__f138['name']" :value="$__f138['value']" :options="$__f138['options']" />
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                @php
                $__f139 = ['name' => 'cCorDENATRAN', 'value' => 'Cor' . ':'];
                @endphp
                <x-form.label :name="$__f139['name']" :value="$__f139['value']" />
                @php
                $__f140 = ['name' => 'cCorDENATRAN', 'list' => App\Models\Veiculo::cores(), 'selected' => '', 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%']];
                @endphp
                <x-form.select :name="$__f140['name']" :list="$__f140['list']" :selected="$__f140['selected']" :options="$__f140['options']" />
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                @php
                $__f141 = ['name' => 'lota', 'value' => 'Capacidade de lotação' . ':'];
                @endphp
                <x-form.label :name="$__f141['name']" :value="$__f141['value']" />
                @php
                $__f142 = ['name' => 'lota', 'value' => '', 'options' => ['class' => 'form-control', 'placeholder' => 'Capacidade de lotação']];
                @endphp
                <x-form.input type="text" :name="$__f142['name']" :value="$__f142['value']" :options="$__f142['options']" />
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                @php
                $__f143 = ['name' => 'tpRest', 'value' => 'Tipo de restrição' . ':'];
                @endphp
                <x-form.label :name="$__f143['name']" :value="$__f143['value']" />
                @php
                $__f144 = ['name' => 'tpRest', 'list' => App\Models\Veiculo::restricoes(), 'selected' => '', 'options' => ['class' => 'form-control select2', 'style' => 'width: 100%']];
                @endphp
                <x-form.select :name="$__f144['name']" :list="$__f144['list']" :selected="$__f144['selected']" :options="$__f144['options']" />
              </div>
            </div>

            @endcomponent
          </div>

          <div class="form-group col-sm-12" id="product_form_part">
            @include('product.partials.single_product_form_part', ['profit_percent' => $default_profit_percent])
          </div>

          <input type="hidden" id="variation_counter" value="1">
          <input type="hidden" id="default_profit_percent"
          value="{{ $default_profit_percent }}">

        </div>

        @endcomponent
        <div class="row">
          <div class="col-sm-12">
            <input type="hidden" name="submit_type" id="submit_type">
            <div class="text-center">
              <div class="btn-group">
                @if($selling_price_group_count)
                <button type="submit" value="submit_n_add_selling_prices" class="btn btn-warning submit_product_form">@lang('lang_v1.save_n_add_selling_price_group_prices')</button>
                @endif

                @can('product.opening_stock')
                <button id="opening_stock_button" @if(!empty($duplicate_product) && $duplicate_product->enable_stock == 0) disabled @endif type="submit" value="submit_n_add_opening_stock" class="btn bg-purple submit_product_form">@lang('lang_v1.save_n_add_opening_stock')</button>
                @endcan

                <button type="submit" value="save_n_add_another" class="btn bg-maroon submit_product_form">@lang('lang_v1.save_n_add_another')</button>

                <button type="submit" value="submit" class="btn btn-primary submit_product_form">@lang('messages.save')</button>
              </div>

            </div>
          </div>
        </div>
        <x-form.close />

      </section>
      <!-- /.content -->

      @endsection

      @section('javascript')
      @php $asset_v = env('APP_VERSION'); @endphp
      <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>

      <script type="text/javascript">
        $(document).ready(function(){
          onScan.attachTo(document, {
                suffixKeyCodes: [13], // enter-key expected at the end of a scan
                reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
                onScan: function(sCode, iQty) {
                  $('input#sku').val(sCode);
                },
                onScanError: function(oDebug) {
                  console.log(oDebug);
                },
                minLength: 2,
                ignoreIfFocusOn: ['input', '.form-control']
                // onKeyDetect: function(iKeyCode){ // output all potentially relevant key events - great for debugging!
                //     console.log('Pressed: ' + iKeyCode);
                // }
              });
        });


        $('#tipo').change(() => {
          let tipo = $('#tipo').val();
          if(tipo == 'veiculo'){
            $('.veiculo').css('display', 'block')
          }else{
            limpaDadosVeiculo()
          }
        })

        function limpaDadosVeiculo(){
          $('.veiculo').css('display', 'none')
        }
      </script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

      @endsection
