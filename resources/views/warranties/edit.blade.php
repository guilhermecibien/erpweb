<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('WarrantyController@update', [$warranty->id]), 'method' => 'put', 'id' => 'warranty_form']];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'lang_v1.edit_warranty' )</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        @php
        $__f2 = ['name' => 'name', 'value' => __( 'lang_v1.name' ) . ':*'];
        @endphp
        <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'name', 'value' => $warranty->name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name' ) ]];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
      </div>

      <div class="form-group">
        @php
        $__f4 = ['name' => 'description', 'value' => __( 'lang_v1.description' ) . ':'];
        @endphp
        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'description', 'value' => $warranty->description, 'options' => ['class' => 'form-control', 'placeholder' => __( 'lang_v1.description' ), 'rows' => 3 ]];
          @endphp
          <x-form.textarea :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
      </div>
      <strong>@php
      <strong>$__f6 = ['name' => 'duration', 'value' => __( 'lang_v1.duration' ) . ':'];
      <strong>@endphp
      <strong><x-form.label :name="$__f6['name']" :value="$__f6['value']" />*</strong>
      <div class="form-group">
          @php
          $__f7 = ['name' => 'duration', 'value' => $warranty->duration, 'options' => ['class' => 'form-control width-40 pull-left', 'placeholder' => __( 'lang_v1.duration' ), 'required' ]];
          @endphp
          <x-form.input type="number" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />

          @php
          $__f8 = ['name' => 'duration_type', 'list' => ['days' => __('lang_v1.days'), 'months' => __('lang_v1.months'), 'years' => __('lang_v1.years')], 'selected' => $warranty->duration_type, 'options' => ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select'), 'required']];
          @endphp
          <x-form.select :name="$__f8['name']" :list="$__f8['list']" :selected="$__f8['selected']" :options="$__f8['options']" />
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->