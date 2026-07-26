<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('VariationTemplateController@store'), 'method' => 'post', 'id' => 'variation_add_form', 'class' => 'form-horizontal' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang('lang_v1.add_variation')</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        @php
        $__f2 = ['name' => 'name', 'value' => __('lang_v1.variation_name') . ':*', 'options' => ['class' => 'col-sm-3 control-label']];
        @endphp
        <x-form.label :name="$__f2['name']" :value="$__f2['value']" :options="$__f2['options']" />

        <div class="col-sm-9">
          @php
          $__f3 = ['name' => 'name', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.variation_name')]];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">@lang('lang_v1.add_variation_values'):*</label>
        <div class="col-sm-7">
           @php
           $__f4 = ['name' => 'variation_values[]', 'value' => null, 'options' => ['class' => 'form-control', 'required']];
           @endphp
           <x-form.input type="text" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
        </div>
        <div class="col-sm-2">
          <button type="button" class="btn btn-primary" id="add_variation_values">+</button>
        </div>
      </div>
      <div id="variation_values"></div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->