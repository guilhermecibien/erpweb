<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('BusinessLocationController@update', [$location->id]), 'method' => 'PUT', 'id' => 'business_location_add_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'business.edit_business_location' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f2 = ['name' => 'name', 'value' => __( 'invoice.name' ) . ':*'];
            @endphp
            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
              @php
              $__f3 = ['name' => 'name', 'value' => $location->name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'invoice.name' ) ]];
              @endphp
              <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f4 = ['name' => 'landmark', 'value' => __( 'business.landmark' ) . ':'];
            @endphp
            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
              @php
              $__f5 = ['name' => 'landmark', 'value' => $location->landmark, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.landmark' ) ]];
              @endphp
              <x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f6 = ['name' => 'city', 'value' => __( 'business.city' ) . ':*'];
            @endphp
            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
              @php
              $__f7 = ['name' => 'city', 'value' => $location->city, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.city'), 'required' ]];
              @endphp
              <x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f8 = ['name' => 'zip_code', 'value' => __( 'business.zip_code' ) . ':*'];
            @endphp
            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
              @php
              $__f9 = ['name' => 'zip_code', 'value' => $location->zip_code, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.zip_code'), 'required' ]];
              @endphp
              <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f10 = ['name' => 'state', 'value' => __( 'business.state' ) . ':*'];
            @endphp
            <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
              @php
              $__f11 = ['name' => 'state', 'value' => $location->state, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.state'), 'required' ]];
              @endphp
              <x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f12 = ['name' => 'country', 'value' => __( 'business.country' ) . ':*'];
            @endphp
            <x-form.label :name="$__f12['name']" :value="$__f12['value']" />
              @php
              $__f13 = ['name' => 'country', 'value' => $location->country, 'options' => ['class' => 'form-control', 'placeholder' => __( 'business.country'), 'required' ]];
              @endphp
              <x-form.input type="text" :name="$__f13['name']" :value="$__f13['value']" :options="$__f13['options']" />
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f14 = ['name' => 'invoice_scheme_id', 'value' => __('invoice.invoice_scheme') . ':*'];
            @endphp
            <x-form.label :name="$__f14['name']" :value="$__f14['value']" /> @show_tooltip(__('tooltip.invoice_scheme'))
              @php
              $__f15 = ['name' => 'invoice_scheme_id', 'list' => $invoice_schemes, 'selected' => $location->invoice_scheme_id, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('messages.please_select')]];
              @endphp
              <x-form.select :name="$__f15['name']" :list="$__f15['list']" :selected="$__f15['selected']" :options="$__f15['options']" />
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            @php
            $__f16 = ['name' => 'invoice_layout_id', 'value' => __('invoice.invoice_layout') . ':*'];
            @endphp
            <x-form.label :name="$__f16['name']" :value="$__f16['value']" /> @show_tooltip(__('tooltip.invoice_layout'))
              @php
              $__f17 = ['name' => 'invoice_layout_id', 'list' => $invoice_layouts, 'selected' => $location->invoice_layout_id, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('messages.please_select')]];
              @endphp
              <x-form.select :name="$__f17['name']" :list="$__f17['list']" :selected="$__f17['selected']" :options="$__f17['options']" />
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