<div class="modal fade" id="update_purchase_status_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

		@php
		$__f1 = ['options' => ['url' => action('PurchaseController@updateStatus'), 'method' => 'post', 'id' => 'update_purchase_status_form' ]];
		@endphp
		<x-form.open :options="$__f1['options']" />

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang( 'lang_v1.update_status' )</h4>
		</div>

		<div class="modal-body">
			<div class="form-group">
				@php
				$__f2 = ['name' => 'status', 'value' => __('purchase.purchase_status') . ':*'];
				@endphp
				<x-form.label :name="$__f2['name']" :value="$__f2['value']" /> 
				@php
				$__f3 = ['name' => 'status', 'list' => $orderStatuses, 'selected' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required']];
				@endphp
				<x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />

				@php
				$__f4 = ['name' => 'purchase_id', 'value' => null, 'options' => ['id' => 'purchase_id']];
				@endphp
				<x-form.input type="hidden" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />
			</div>
		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
		</div>

		<x-form.close />

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>