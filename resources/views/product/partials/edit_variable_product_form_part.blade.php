<div class="col-sm-12">
  <h4>Add Variation:* 
  <button type="button" class="btn btn-primary" id="add_variation" data-action="edit" >+</button></h4>
</div>
<div class="col-sm-12">
    <div class="table-responsive">
    <table class="table table-bordered add-product-price-table table-condensed" id="product_variation_form_part">
        <thead>
          <tr>
            <th class="col-sm-2">@lang('product.variation_name')</th>
            <th class="col-sm-9">@lang('product.variation_values')</th>
          </tr>
        </thead>
        <tbody>
        @foreach( $product_variations as $product_variation)
          <?php $count = $loop->index; ?>
          <tr class="variation_row">
            <td>
              @php
              $__f1 = ['name' => 'product_variation[' . $loop->index . '][name]', 'value' => $product_variation->name, 'options' => ['class' => 'form-control input-sm variation_name', 'required']];
              @endphp
              <x-form.input type="text" :name="$__f1['name']" :value="$__f1['value']" :options="$__f1['options']" />
              <input type="hidden" class="row_index" value="{{  $loop->index }}">
              @php
              $__f2 = ['name' => 'product_variation[' . $loop->index . '][product_variation_id]', 'value' => $product_variation->id];
              @endphp
              <x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" />
            </td>
            <td>
                <table class="table table-condensed table-bordered blue-header variation_value_table">
                    <tr>
                        <th>@lang('product.value')</th>
                        <th>@lang('product.default_purchase_price') &nbsp;&nbsp;<b><i class="fa fa-info-circle" aria-hidden="true" data-toggle="popover" data-html="true" data-trigger="hover" data-content="<p class='text-primary'>Drag the mouse over the table cells to copy input values</p>" data-placement="top"></i></b></th>
                        <th>@lang('product.default_selling_price') &nbsp;&nbsp;<b><i class="fa fa-info-circle" aria-hidden="true" data-toggle="popover" data-html="true" data-trigger="hover" data-content="<p class='text-primary'>Drag the mouse over the table cells to copy input values</p>" data-placement="top"></i></b></th>
                        <th><button type="button" class="btn btn-success btn-xs add_variation_value_row">+</button></th>
                    </tr>
                    @foreach($product_variation->variations as $variation )
                    <tr>
                        <td>
                          @php
                          $__f3 = ['name' => 'product_variation[' . $loop->parent->index . '][variations][' . $loop->index . '][value]', 'value' => $variation->name, 'options' => ['class' => 'form-control input-sm variation_value_name', 'required']];
                          @endphp
                          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
                          @php
                          $__f4 = ['name' => 'product_variation[' . $loop->parent->index . '][variations][' . $loop->index . '][variation_id]', 'value' => $variation->id];
                          @endphp
                          <x-form.input type="hidden" :name="$__f4['name']" :value="$__f4['value']" />
                        </td>
                        <td class="drag-select">
                          @php
                          $__f5 = ['name' => 'product_variation[' . $loop->parent->index . '][variations][' . $loop->index . '][default_purchase_price]', 'value' => $variation->default_purchase_price, 'options' => ['class' => 'form-control input-sm dpp', 'min' => '0']];
                          @endphp
                          <x-form.input type="number" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
                        </td>
                        <td class="drag-select">
                          @php
                          $__f6 = ['name' => 'product_variation[' . $loop->parent->index . '][variations][' . $loop->index . '][default_sell_price]', 'value' => $variation->default_sell_price, 'options' => ['class' => 'form-control input-sm variable_dsp', 'min' => '0', 'placeholder' => __('product.exc_of_tax')]];
                          @endphp
                          <x-form.input type="number" :name="$__f6['name']" :value="$__f6['value']" :options="$__f6['options']" />
                          @php
                          $__f7 = ['name' => 'product_variation[' . $loop->parent->index . '][variations][' . $loop->index . '][sell_price_inc_tax]', 'value' => $variation->sell_price_inc_tax, 'options' => ['class' => 'form-control input-sm variable_dsp_inc_tax', 'min' => '0', 'placeholder' => __('product.inc_of_tax')]];
                          @endphp
                          <x-form.input type="number" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
                        </td>
                        <td><button type="button" class="btn btn-danger btn-xs remove_variation_value_row">-</button>
                        <input type="hidden" class="variation_row_index" value="{{ $loop->index }}"></td>
                    </tr>
                    @endforeach
                </table>
            </td>
          </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
<input type="hidden" id="variation_counter" value="{{ $count + 1 }}">