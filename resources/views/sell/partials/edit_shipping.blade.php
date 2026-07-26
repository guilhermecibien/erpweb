<div class="modal-dialog" role="document">
	@php
	$__f1 = ['options' => ['url' => action('SellController@updateShipping', [$transaction->id]), 'method' => 'put', 'id' => 'edit_shipping_form' ]];
	@endphp
	<x-form.open :options="$__f1['options']" />
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang('lang_v1.edit_shipping') - {{$transaction->invoice_no}}</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-6">
			        <div class="form-group">
			            @php
			            $__f2 = ['name' => 'shipping_details', 'value' => __('sale.shipping_details') . ':*'];
			            @endphp
			            <x-form.label :name="$__f2['name']" :value="$__f2['value']" />
			            @php
			            $__f3 = ['name' => 'shipping_details', 'value' => !empty($transaction->shipping_details) ? $transaction->shipping_details : '', 'options' => ['class' => 'form-control','placeholder' => __('sale.shipping_details'), 'required' ,'rows' => '4']];
			            @endphp
			            <x-form.textarea :name="$__f3['name']" :value="$__f3['value']" :options="$__f3['options']" />
			        </div>
			    </div>

			    <div class="col-md-6">
			        <div class="form-group">
			            @php
			            $__f4 = ['name' => 'shipping_address', 'value' => __('lang_v1.shipping_address') . ':'];
			            @endphp
			            <x-form.label :name="$__f4['name']" :value="$__f4['value']" />
			            @php
			            $__f5 = ['name' => 'shipping_address', 'value' => !empty($transaction->shipping_address) ? $transaction->shipping_address : '', 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.shipping_address') ,'rows' => '4']];
			            @endphp
			            <x-form.textarea :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
			        </div>
			    </div>

			    <div class="col-md-6">
			        <div class="form-group">
			            @php
			            $__f6 = ['name' => 'shipping_status', 'value' => __('lang_v1.shipping_status') . ':'];
			            @endphp
			            <x-form.label :name="$__f6['name']" :value="$__f6['value']" />
			            @php
			            $__f7 = ['name' => 'shipping_status', 'list' => $shipping_statuses, 'selected' => !empty($transaction->shipping_status) ? $transaction->shipping_status : null, 'options' => ['class' => 'form-control','placeholder' => __('messages.please_select')]];
			            @endphp
			            <x-form.select :name="$__f7['name']" :list="$__f7['list']" :selected="$__f7['selected']" :options="$__f7['options']" />
			        </div>
			    </div>

			    <div class="col-md-6">
			        <div class="form-group">
			            @php
			            $__f8 = ['name' => 'delivered_to', 'value' => __('lang_v1.delivered_to') . ':'];
			            @endphp
			            <x-form.label :name="$__f8['name']" :value="$__f8['value']" />
			            @php
			            $__f9 = ['name' => 'delivered_to', 'value' => !empty($transaction->delivered_to) ? $transaction->delivered_to : null, 'options' => ['class' => 'form-control','placeholder' => __('lang_v1.delivered_to')]];
			            @endphp
			            <x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
			        </div>
			    </div>

			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">@lang('messages.update')</button>
		    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
		</div>
		<x-form.close />
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->