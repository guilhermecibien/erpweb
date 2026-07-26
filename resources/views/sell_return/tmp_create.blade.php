@extends('layouts.app')
@section('title', __('lang_v1.sell_return'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>@lang('lang_v1.sell_return')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content no-print">

	@include('layouts.partials.error')

	@if(count($business_locations) == 1)
		@php 
			$default_location = current(array_keys($business_locations->toArray())) 
		@endphp
	@else
		@php $default_location = null; @endphp
	@endif
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				@php
				$__f1 = ['name' => 'location_id', 'value' => __('purchase.business_location').':*'];
				@endphp
				<x-form.label :name="$__f1['name']" :value="$__f1['value']" />
				@php
				$__f2 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => $default_location, 'options' => ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'select_location_id']];
				@endphp
				<x-form.select :name="$__f2['name']" :list="$__f2['list']" :selected="$__f2['selected']" :options="$__f2['options']" />
			</div>
		</div>
	</div>
	<input type="hidden" id="product_row_count" value="0">
	
	@php
	$__f3 = ['options' => ['url' => action('SellReturnController@store'), 'method' => 'post', 'id' => 'sell_return_form' ]];
	@endphp
	<x-form.open :options="$__f3['options']" />
	
	<div class="box box-solid">
		<div class="box-body">
			<div class="row">
				@php
				$__f4 = ['name' => 'location_id', 'value' => $default_location, 'options' => ['id' => 'location_id']];
				@endphp
				<x-form.input type="hidden" :name="$__f4['name']" :value="$__f4['value']" :options="$__f4['options']" />

				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f5 = ['name' => 'contact_id', 'value' => __('contact.customer') . ':*'];
						@endphp
						<x-form.label :name="$__f5['name']" :value="$__f5['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>
							@php
							$__f6 = ['name' => 'contact_id', 'list' => [], 'selected' => null, 'options' => ['class' => 'form-control', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required']];
							@endphp
							<x-form.select :name="$__f6['name']" :list="$__f6['list']" :selected="$__f6['selected']" :options="$__f6['options']" />
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f7 = ['name' => 'invoice_no', 'value' => __('purchase.ref_no').':'];
						@endphp
						<x-form.label :name="$__f7['name']" :value="$__f7['value']" />
						@php
						$__f8 = ['name' => 'invoice_no', 'value' => null, 'options' => ['class' => 'form-control']];
						@endphp
						<x-form.input type="text" :name="$__f8['name']" :value="$__f8['value']" :options="$__f8['options']" />
					</div>
				</div>

				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f9 = ['name' => 'transaction_date', 'value' => __('purchase.purchase_date') . ':*'];
						@endphp
						<x-form.label :name="$__f9['name']" :value="$__f9['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							@php
							$__f10 = ['name' => 'transaction_date', 'value' => \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format')), 'options' => ['class' => 'form-control', 'readonly', 'required']];
							@endphp
							<x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
						</div>
					</div>
				</div>
				
				
			</div>
		</div>
	</div> <!--box end-->

	<div class="box box-solid"><!--box start-->
		<div class="box-body">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span>
							@php
							$__f11 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'disabled' => is_null($default_location)? true : false, 'autofocus' => is_null($default_location)? false : true, ]];
							@endphp
							<x-form.input type="text" :name="$__f11['name']" :value="$__f11['value']" :options="$__f11['options']" />
						</div>
					</div>
				</div>
			</div>
			@php
				$hide_tax = '';
				if( session()->get('business.enable_inline_tax') == 0){
					$hide_tax = 'hide';
				}
			@endphp

			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table class="table table-condensed table-bordered table-th-green text-center table-striped" id="purchase_entry_table">
							<thead>
								<tr>
									<th class="text-center">	
										@lang('sale.product')
									</th>
									<th class="text-center">
										@lang('sale.qty')
									</th>
									<th class="text-center">
										@lang('sale.unit_price')
									</th>
									<th class="text-center {{$hide_tax}}">
										@lang('sale.tax')
									</th>
									<th class="text-center {{$hide_tax}}">
										@lang('sale.price_inc_tax')
									</th>
									<th class="text-center">
										@lang('sale.subtotal')
									</th>

									@if(session('business.enable_lot_number'))
										<th class="text-center">
											@lang('lang_v1.lot_number')
										</th>
									@endif

									@if(session('business.enable_product_expiry'))
										<th class="text-center">
											@lang('product.exp_date')
										</th>
									@endif

									<th class="text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<hr/>
					<div class="pull-right col-md-5">
						<table class="pull-right col-md-12">
							<tr class="hide">
								<th class="col-md-7 text-right">@lang( 'purchase.total_before_tax' ):</th>
								<td class="col-md-5 text-left">
									<span id="total_st_before_tax" class="display_currency"></span>
									<input type="hidden" id="st_before_tax_input" value=0>
								</td>
							</tr>
							<tr>
								<th class="col-md-7 text-right">@lang( 'purchase.net_total_amount' ):</th>
								<td class="col-md-5 text-left">
									<span id="price_total" class="display_currency"></span>
									<!-- This is total before purchase tax-->
									<input type="hidden" id="total_subtotal_input" value=0  name="total_before_tax">
								</td>
							</tr>
						</table>
					</div>

					<input type="hidden" id="row_count" value="0">
				</div>
			</div>
		</div>
	</div><!--box end-->
	<div class="box box-solid"><!--box start-->
		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
				<table class="table">
					<tr>
						<td class="col-md-3">
							<div class="form-group">
								@php
								$__f12 = ['name' => 'discount_type', 'value' => __( 'purchase.discount_type' ) . ':'];
								@endphp
								<x-form.label :name="$__f12['name']" :value="$__f12['value']" />
								@php
								$__f13 = ['name' => 'discount_type', 'list' => [ '' => __('lang_v1.none'), 'fixed' => __( 'lang_v1.fixed' ), 'percentage' => __( 'lang_v1.percentage' )], 'selected' => '', 'options' => ['class' => 'form-control']];
								@endphp
								<x-form.select :name="$__f13['name']" :list="$__f13['list']" :selected="$__f13['selected']" :options="$__f13['options']" />
							</div>
						</td>
						<td class="col-md-3">
							<div class="form-group">
							@php
							$__f14 = ['name' => 'discount_amount', 'value' => __( 'purchase.discount_amount' ) . ':'];
							@endphp
							<x-form.label :name="$__f14['name']" :value="$__f14['value']" />
							@php
							$__f15 = ['name' => 'discount_amount', 'value' => 0, 'options' => ['class' => 'form-control input_number', 'required']];
							@endphp
							<x-form.input type="text" :name="$__f15['name']" :value="$__f15['value']" :options="$__f15['options']" />
							</div>
						</td>
						<td class="col-md-3">
							&nbsp;
						</td>
						<td class="col-md-3">
							<b>@lang( 'purchase.discount' ):</b>(-) 
							<span id="total_discount" class="display_currency">0</span>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>
							@php
							$__f16 = ['name' => 'final_total', 'value' => 0, 'options' => ['id' => 'final_total_input']];
							@endphp
							<x-form.input type="hidden" :name="$__f16['name']" :value="$__f16['value']" :options="$__f16['options']" />
							<b>@lang('lang_v1.total_credit_amt'): </b><span id="total_payable" class="display_currency" data-currency_symbol='true'>0</span>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="form-group">
								@php
								$__f17 = ['name' => 'additional_notes', 'value' => __('purchase.additional_notes')];
								@endphp
								<x-form.label :name="$__f17['name']" :value="$__f17['value']" />
								@php
								$__f18 = ['name' => 'additional_notes', 'value' => null, 'options' => ['class' => 'form-control', 'rows' => 3]];
								@endphp
								<x-form.textarea :name="$__f18['name']" :value="$__f18['value']" :options="$__f18['options']" />
							</div>
						</td>
					</tr>

				</table>
				</div>
		</div>

		<div class="row">
		<div class="col-sm-12">
			<button type="button" id="submit_sell_return_form" class="btn btn-primary pull-right btn-flat">@lang('messages.save')</button>
		</div>
		</div>

	</div><!--box end-->
<x-form.close />
</section>
<!-- /.content -->
@endsection

@section('javascript')
	<script src="{{ asset('js/sell_return.js?v=' . $asset_v) }}"></script>
@endsection
