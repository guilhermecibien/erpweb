<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
	@php
	$__f1 = ['options' => ['url' => action('OpeningStockController@save'), 'method' => 'post', 'id' => 'add_opening_stock_form' ]];
	@endphp
	<x-form.open :options="$__f1['options']" />
	@php
	$__f2 = ['name' => 'product_id', 'value' => $product->id];
	@endphp
	<x-form.input type="hidden" :name="$__f2['name']" :value="$__f2['value']" />
		<div class="modal-header">
		    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      <h4 class="modal-title" id="modalTitle">@lang('lang_v1.add_opening_stock')</h4>
	    </div>
	    <div class="modal-body">
			@include('opening_stock.form-part')
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" id="add_opening_stock_btn">@lang('messages.save')</button>
		    <button type="button" class="btn btn-default no-print" data-dismiss="modal">@lang( 'messages.close' )</button>
		 </div>
	 <x-form.close />
	</div>
</div>
