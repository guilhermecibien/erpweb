<div class="modal fade" id="configure_search_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					@lang('lang_v1.search_products_by')
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="checkbox">
							<label>
				              	@php
				              	$__f1 = ['name' => 'search_fields[]', 'value' => 'name', 'checked' => true, 'options' => ['class' => 'input-icheck search_fields']];
				              	@endphp
				              	<x-form.checkbox :name="$__f1['name']" :value="$__f1['value']" :checked="$__f1['checked']" :options="$__f1['options']" /> @lang('product.product_name')
				            </label>
						</div>
					</div>
					<div class="col-md-12">
						<div class="checkbox">
							<label>
				              	@php
				              	$__f2 = ['name' => 'search_fields[]', 'value' => 'sku', 'checked' => true, 'options' => ['class' => 'input-icheck search_fields']];
				              	@endphp
				              	<x-form.checkbox :name="$__f2['name']" :value="$__f2['value']" :checked="$__f2['checked']" :options="$__f2['options']" /> @lang('product.sku')
				            </label>
						</div>
					</div>
					@if(request()->session()->get('business.enable_lot_number') == 1)
					<div class="col-md-12">
						<div class="checkbox">
							<label>
				              	@php
				              	$__f3 = ['name' => 'search_fields[]', 'value' => 'lot_number', 'checked' => true, 'options' => ['class' => 'input-icheck search_fields']];
				              	@endphp
				              	<x-form.checkbox :name="$__f3['name']" :value="$__f3['value']" :checked="$__f3['checked']" :options="$__f3['options']" /> @lang('lang_v1.lot_number')
				            </label>
						</div>
					</div>
					@endif
				</div>
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
			</div>
		</div>
	</div>
</div>