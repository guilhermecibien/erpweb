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

<div class="table-responsive">
    <table class="table table-bordered add-product-price-table table-condensed {{$class}}">
        <tr>
          <th>@lang('product.default_purchase_price')</th>
          <th>@lang('product.profit_percent') @show_tooltip(__('tooltip.profit_percent'))</th>
          <th>@lang('product.default_selling_price')</th>
          @if(empty($quick_add))
            <th>@lang('lang_v1.product_image')</th>
          @endif
        </tr>
        <tr>
          <td>
            <div class="col-sm-6">
              @php
              $__f1 = ['name' => 'single_dpp', 'value' => trans('product.exc_of_tax') . ':*'];
              @endphp
              <x-form.label :name="$__f1['name']" :value="$__f1['value']" />

              @php
              $__f2 = ['name' => 'single_dpp', 'value' => $default, 'options' => ['class' => 'form-control input-sm dpp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']];
              @endphp
              <x-form.input type="text" :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />
            </div>

            <div class="col-sm-6">
              @php
              $__f3 = ['name' => 'single_dpp_inc_tax', 'value' => trans('product.inc_of_tax') . ':*'];
              @endphp
              <x-form.label :name="$__f3['name']" :value="$__f3['value']" />
            
              @php
              $__f4 = ['name' => 'single_dpp_inc_tax', 'value' => $default, 'options' => ['class' => 'form-control input-sm dpp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']];
              @endphp
              <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
            </div>
          </td>

          <td>
            <br/>
            @php
            $__f5 = ['name' => 'profit_percent', 'value' => number_format($profit_percent, 2, ',', '.'), 'options' => ['class' => 'form-control input-sm input_number', 'id' => 'profit_percent', 'required']];
            @endphp
            <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
          </td>

          <td>
            <label><span class="dsp_label">@lang('product.exc_of_tax')</span></label>
            @php
            $__f6 = ['name' => 'single_dsp', 'value' => $default, 'options' => ['class' => 'form-control input-sm dsp input_number', 'placeholder' => __('product.exc_of_tax'), 'id' => 'single_dsp', 'required']];
            @endphp
            <x-form.input type="text" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />

            @php
            $__f7 = ['name' => 'single_dsp_inc_tax', 'value' => $default, 'options' => ['class' => 'form-control input-sm hide input_number', 'placeholder' => __('product.inc_of_tax'), 'id' => 'single_dsp_inc_tax', 'required']];
            @endphp
            <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
          </td>
          @if(empty($quick_add))
          <td>
              <div class="form-group">
                @php
                $__f8 = ['name' => 'variation_images', 'value' => __('lang_v1.product_image') . ':'];
                @endphp
                <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
                @php
                $__f9 = ['name' => 'variation_images[]', 'options' => ['class' => 'variation_images', 'accept' => 'image/*', 'multiple']];
                @endphp
                <x-form.input type="file" :name="$__f9['name']" :options="$__f9['options']" />
                <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) <br> @lang('lang_v1.aspect_ratio_should_be_1_1')</p></small>
              </div>
          </td>
          @endif
        </tr>
    </table>
</div>