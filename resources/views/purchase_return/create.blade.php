@extends('layouts.app')
@section('title', __('lang_v1.add_purchase_return'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
<br>
    <h1>@lang('lang_v1.add_purchase_return')</h1>
</section>

<!-- Main content -->
<section class="content no-print">
	@php
	$__f1 = ['options' => ['url' => action('CombinedPurchaseReturnController@save'), 'method' => 'post', 'id' => 'purchase_return_form', 'files' => true ]];
	@endphp
	<x-form.open :options="$__f1['options']" />
	<div class="box box-solid">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f2 = ['name' => 'supplier_id', 'value' => __('purchase.supplier') . ':*'];
						@endphp
						<x-form.label :name="$__f2['name']" :value="$__f2['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>
							@php
							$__f3 = ['name' => 'contact_id', 'list' => [], 'selected' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'supplier_id']];
							@endphp
							<x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f4 = ['name' => 'location_id', 'value' => __('purchase.business_location').':*'];
						@endphp
						<x-form.label :name="$__f4['name']" :value="$__f4['value']" />
						@php
						$__f5 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
						@endphp
						<x-form.select :name="$__f5['name']" :list="$__f5['list']" :selected="$__f5['selected']" :options="$__f5['options']" />
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f6 = ['name' => 'ref_no', 'value' => __('purchase.ref_no').':'];
						@endphp
						<x-form.label :name="$__f6['name']" :value="$__f6['value']" />
						@php
						$__f7 = ['name' => 'ref_no', 'value' => null, 'options' => ['class' => 'form-control']];
						@endphp
						<x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f8 = ['name' => 'transaction_date', 'value' => __('messages.date') . ':*'];
						@endphp
						<x-form.label :name="$__f8['name']" :value="$__f8['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							@php
							$__f9 = ['name' => 'transaction_date', 'value' => \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . (session('business.time_format') == 24 ? 'H:i' : 'h:i A')), 'options' => ['class' => 'form-control', 'readonly', 'required']];
							@endphp
							<x-form.input type="text" :name="$__f9['name']" :value="$__f9['value']" :options="$__f9['options']" />
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-3">
	                <div class="form-group">
	                    @php
	                    $__f10 = ['name' => 'document', 'value' => __('purchase.attach_document') . ':'];
	                    @endphp
	                    <x-form.label :name="$__f10['name']" :value="$__f10['value']" />
	                    @php
	                    $__f11 = ['name' => 'document', 'options' => ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]];
	                    @endphp
	                    <x-form.input type="file" :name="$__f11['name']" :options="$__f11['options']" />
	                    <p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
	                    @includeIf('components.document_help_text')</p>
	                </div>
	            </div>
			</div>
		</div>
	</div> <!--box end-->
	<div class="box box-solid">
		<div class="box-header">
        	<h3 class="box-title">{{ __('stock_adjustment.search_products') }}</h3>
       	</div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							@php
							$__f12 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control', 'id' => 'search_product_for_purchase_return', 'placeholder' => __('stock_adjustment.search_products'), 'disabled']];
							@endphp
							<x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input type="hidden" id="product_row_index" value="0">
					<input type="hidden" id="total_amount" name="final_total" value="0">
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-condensed" 
					id="purchase_return_product_table">
						<thead>
							<tr>
								<th class="text-center">	
									@lang('sale.product')
								</th>
								@if(session('business.enable_lot_number'))
									<th>
										@lang('lang_v1.lot_number')
									</th>
								@endif
								@if(session('business.enable_product_expiry'))
									<th>
										@lang('product.exp_date')
									</th>
								@endif
								<th class="text-center">
									@lang('sale.qty')
								</th>
								<th class="text-center">
									@lang('sale.unit_price')
								</th>
								<th class="text-center">
									@lang('sale.subtotal')
								</th>
								<th class="text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-4">
					<div class="form-group">
						@php
						$__f13 = ['name' => 'tax_id', 'value' => __('purchase.purchase_tax') . ':'];
						@endphp
						<x-form.label :name="$__f13['name']" :value="$__f13['value']" />
						<select name="tax_id" id="tax_id" class="form-control select2" placeholder="'Please Select'">
							<option value="" data-tax_amount="0" data-tax_type="fixed" selected>@lang('lang_v1.none')</option>
							@foreach($taxes as $tax)
								<option value="{{ $tax->id }}" data-tax_amount="{{ $tax->amount }}" data-tax_type="{{ $tax->calculation_type }}">{{ $tax->name }}</option>
							@endforeach
						</select>
						@php
						$__f14 = ['name' => 'tax_amount', 'value' => 0, 'options' => ['id' => 'tax_amount']];
						@endphp
						<x-form.input type="hidden" :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
					</div>
				</div>
				<div class="col-md-8">
					<div class="pull-right"><b>@lang('stock_adjustment.total_amount'):</b> <span id="total_return">0.00</span></div>
				</div>
			</div>
		</div>
	</div> <!--box end-->
	<div class="row">
		<div class="col-md-12">
			<button type="button" id="submit_purchase_return_form" class="btn btn-primary pull-right btn-flat">@lang('messages.submit')</button>
		</div>
	</div>
	<x-form.close />
</section>
@stop
@section('javascript')
	<script src="{{ asset('js/purchase_return.js?v=' . $asset_v) }}"></script>
@endsection
