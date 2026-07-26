<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('DiscountController@store'), 'method' => 'post', 'id' => 'discount_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'lang_v1.add_discount' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            @php
            $__f2 = ['name' => 'name', 'value' => __( 'unit.name' ) . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
              @php
              $__f3 = ['name' => 'name', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'unit.name' ) ]];
              @endphp
              <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'brand_id', 'value' => __('product.brand') . ':'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
              @php
              $__f5 = ['name' => 'brand_id', 'list' => $brands, 'selected' => null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']];
              @endphp
              <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f6 = ['name' => 'category_id', 'value' => __('product.category') . ':'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
              @php
              $__f7 = ['name' => 'category_id', 'list' => $categories, 'selected' => null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']];
              @endphp
              <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f8 = ['name' => 'location_id', 'value' => __('sale.location') . ':*'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
              @php
              $__f9 = ['name' => 'location_id', 'list' => $locations, 'selected' => null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']];
              @endphp
              <x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f10 = ['name' => 'priority', 'value' => __( 'lang_v1.priority' ) . ':'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" /> @show_tooltip(__('lang_v1.discount_priority_help'))
              @php
              $__f11 = ['name' => 'priority', 'value' => null, 'options' => ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'lang_v1.priority' ) ]];
              @endphp
              <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            @php
            $__f12 = ['name' => 'discount_type', 'value' => __('sale.discount_type') . ':*'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
              @php
              $__f13 = ['name' => 'discount_type', 'list' => ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], 'selected' => null, 'options' => ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']];
              @endphp
              <x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f14 = ['name' => 'discount_amount', 'value' => __( 'sale.discount_amount' ) . ':*'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" />
              @php
              $__f15 = ['name' => 'discount_amount', 'value' => null, 'options' => ['class' => 'form-control input_number', 'required', 'placeholder' => __( 'sale.discount_amount' ) ]];
              @endphp
              <x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f16 = ['name' => 'starts_at', 'value' => __( 'lang_v1.starts_at' ) . ':'];
            @endphp
            <x-form.label :name="$__f16['name']" :value="$__f16['value']" />
              @php
              $__f17 = ['name' => 'starts_at', 'value' => null, 'options' => ['class' => 'form-control discount_date', 'required', 'placeholder' => __( 'lang_v1.starts_at' ), 'readonly' ]];
              @endphp
              <x-form.input type="text" :name="$__f17['name']" :value="$__f17['value']" :options="$__f17['options']" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            @php
            $__f18 = ['name' => 'ends_at', 'value' => __( 'lang_v1.ends_at' ) . ':'];
            @endphp
            <x-form.label :name="$__f18['name']" :value="$__f18['value']" />
              @php
              $__f19 = ['name' => 'ends_at', 'value' => null, 'options' => ['class' => 'form-control discount_date', 'required', 'placeholder' => __( 'lang_v1.ends_at' ), 'readonly' ]];
              @endphp
              <x-form.input type="text" :name="$__f19['name']" :value="$__f19['value']" :options="$__f19['options']" />
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            <br>
            <label>
              @php
              $__f20 = ['name' => 'applicable_in_spg', 'value' => 1, 'checked' => false, 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f20['name']" :value="$__f20['value']" :checked="$__f20['checked']" :options="$__f20['options']" /> <strong>@lang('lang_v1.applicable_in_cpg')</strong>
            </label>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <br>
            <label>
              @php
              $__f21 = ['name' => 'applicable_in_cg', 'value' => 1, 'checked' => false, 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f21['name']" :value="$__f21['value']" :checked="$__f21['checked']" :options="$__f21['options']" /> <strong>@lang('lang_v1.applicable_in_cg')</strong>
            </label>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>
              @php
              $__f22 = ['name' => 'is_active', 'value' => 1, 'checked' => true, 'options' => ['class' => 'input-icheck']];
              @endphp
              <x-form.checkbox :name="$__f22['name']" :value="$__f22['value']" :checked="$__f22['checked']" :options="$__f22['options']" /> <strong>@lang('lang_v1.is_active')</strong>
            </label>
          </div>
        </div>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->