<div class="modal-dialog" role="document">
  	<div class="modal-content">

    @php
    $__f1 = ['options' => ['url' => action('AccountTypeController@update', $account_type->id), 'method' => 'put', 'id' => 'account_type_form' ]];
    @endphp
    <x-form.open :options="$__f1['options']" />
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'lang_v1.edit_account_type' )</h4>
    </div>

    <div class="modal-body">
      	<div class="form-group">
        	@php
        	$__f2 = ['name' => 'name', 'value' => __( 'lang_v1.name' ) . ':*'];
        	@endphp
        	<x-form.label :name="$__f2['name']" :value="$__f2['value']" />
          	@php
          	$__f3 = ['name' => 'name', 'value' => $account_type->name, 'options' => ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name' )]];
          	@endphp
          	<x-form.input type="text" :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
      	</div>

      <div class="form-group">
        	@php
        	$__f4 = ['name' => 'parent_account_type_id', 'value' => __( 'lang_v1.parent_account_type' ) . ':'];
        	@endphp
        	<x-form.label :name="$__f4['name']" :value="$__f4['value']" />
          	@php
          	$__f5 = ['name' => 'parent_account_type_id', 'list' => $account_types->pluck('name', 'id'), 'selected' => $account_type->parent_account_type_id, 'options' => ['class' => 'form-control', 'placeholder' => __( 'messages.please_select' )]];
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