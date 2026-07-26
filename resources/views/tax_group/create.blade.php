<div class="modal-dialog" role="document">
  <div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('GroupTaxController@store'), 'method' => 'post', 'id' => 'tax_group_add_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'tax_rate.add_tax_group' )</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        @php
        $__f2 = ['name' => 'name', 'value' => __( 'tax_rate.name' ) . ':*'];
        @endphp
        <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          @php
          $__f3 = ['name' => 'name', 'value' => null, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'tax_rate.name' )]];
          @endphp
          <x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
      </div>

      <div class="form-group">
        @php
        $__f4 = ['name' => 'taxes[]', 'value' => __( 'tax_rate.sub_taxes' ) . ':*'];
        @endphp
        <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          @php
          $__f5 = ['name' => 'taxes[]', 'list' => $taxes, 'selected' => null, 'options' => ['class' => 'form-control select2', 'required', 'multiple']];
          @endphp
          <x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    <x-form.close />

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->