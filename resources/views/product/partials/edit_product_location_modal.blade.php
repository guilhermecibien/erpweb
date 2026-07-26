<div class="modal fade" id="edit_product_location_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	@php
	    	$__f1 = ['options' => ['url' => action('ProductController@updateProductLocation'), 'method' => 'post', 'id' => 'edit_product_location_form' ]];
	    	@endphp
	    	<x-form.open :options="$__f1['options']" />
		    	<div class="modal-header">
			    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				      <h4 class="modal-title"><span class="add_to_location_title hide">@lang( 'lang_v1.add_location_to_the_selected_products' )</span><span class="remove_from_location_title hide">@lang( 'lang_v1.remove_location_from_the_selected_products' )</span></h4>
			    </div>
			    <div class="modal-body">
			    	<div class="form-group">
		                @php
		                $__f2 = ['name' => 'product_location', 'value' => __('purchase.business_location') . ':'];
		                @endphp
		                <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
		                @php
		                $__f3 = ['name' => 'product_location[]', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control', 'style' => 'width:100%', 'required', 'multiple', 'id' => 'product_location']];
		                @endphp
		                <x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
		                @php
		                $__f4 = ['name' => 'products', 'value' => null, 'options' => ['id' => 'products_to_update_location']];
		                @endphp
		                <x-form.input type="hidden" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />

		                @php
		                $__f5 = ['name' => 'update_type', 'value' => null, 'options' => ['id' => 'update_type']];
		                @endphp
		                <x-form.input type="hidden" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
		            </div>
			    </div>
			    <div class="modal-footer">
		      		<button type="submit" class="btn btn-primary" id="update_product_location">@lang( 'messages.save' )</button>
		      		<button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
		    	</div>
	    	<x-form.close />
	    </div>
    </div>
</div>