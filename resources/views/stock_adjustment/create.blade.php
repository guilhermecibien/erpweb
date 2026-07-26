@extends('layouts.app')
@section('title', __('stock_adjustment.add'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
<br>
    <h1>@lang('stock_adjustment.add')</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content no-print">
	@php
	$__f1 = ['options' => ['url' => action('StockAdjustmentController@store'), 'method' => 'post', 'id' => 'stock_adjustment_form' ]];
	@endphp
	<x-form.open :options="$__f1['options']" />
	<div class="box box-solid">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f2 = ['name' => 'location_id', 'value' => __('purchase.business_location').':*'];
						@endphp
						<x-form.label :name="$__f2['name']" :value="$__f2['value']" />
						@php
						$__f3 = ['name' => 'location_id', 'list' => $business_locations, 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
						@endphp
						<x-form.select :name="$__f3['name']" :list="$__f3['list']" :selected="$__f3['selected']" :options="$__f3['options']" />
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f4 = ['name' => 'ref_no', 'value' => __('purchase.ref_no').':'];
						@endphp
						<x-form.label :name="$__f4['name']" :value="$__f4['value']" />
						@php
						$__f5 = ['name' => 'ref_no', 'value' => null, 'options' => ['class' => 'form-control']];
						@endphp
						<x-form.input type="text" :name="$__f5['name']" :value="$__f5['value']" :options="$__f5['options']" />
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f6 = ['name' => 'transaction_date', 'value' => __('messages.date') . ':*'];
						@endphp
						<x-form.label :name="$__f6['name']" :value="$__f6['value']" />
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							@php
							$__f7 = ['name' => 'transaction_date', 'value' => \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . (session('business.time_format') == 24 ? 'H:i' : 'h:i A')), 'options' => ['class' => 'form-control', 'readonly', 'required']];
							@endphp
							<x-form.input type="text" :name="$__f7['name']" :value="$__f7['value']" :options="$__f7['options']" />
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						@php
						$__f8 = ['name' => 'adjustment_type', 'value' => __('stock_adjustment.adjustment_type') . ':*'];
						@endphp
						<x-form.label :name="$__f8['name']" :value="$__f8['value']" /> @show_tooltip(__('tooltip.adjustment_type'))
						@php
						$__f9 = ['name' => 'adjustment_type', 'list' => [ 'normal' =>  __('stock_adjustment.normal'), 'abnormal' =>  __('stock_adjustment.abnormal')], 'selected' => null, 'options' => ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']];
						@endphp
						<x-form.select :name="$__f9['name']" :list="$__f9['list']" :selected="$__f9['selected']" :options="$__f9['options']" />
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
							$__f10 = ['name' => 'search_product', 'value' => null, 'options' => ['class' => 'form-control', 'id' => 'search_product_for_srock_adjustment', 'placeholder' => __('stock_adjustment.search_product'), 'disabled']];
							@endphp
							<x-form.input type="text" :name="$__f10['name']" :value="$__f10['value']" :options="$__f10['options']" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<input type="hidden" id="product_row_index" value="0">
					<input type="hidden" id="total_amount" name="final_total" value="0">
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-condensed" 
					id="stock_adjustment_product_table">
						<thead>
							<tr>
								<th class="col-sm-4 text-center">	
									@lang('sale.product')
								</th>
								<th class="col-sm-2 text-center">
									@lang('sale.qty')
								</th>
								<th class="col-sm-2 text-center">
									@lang('sale.unit_price')
								</th>
								<th class="col-sm-2 text-center">
									@lang('sale.subtotal')
								</th>
								<th class="col-sm-2 text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							<tr class="text-center"><td colspan="3"></td><td><div class="pull-right"><b>@lang('stock_adjustment.total_amount'):</b> <span id="total_adjustment">0.00</span></div></td></tr>
						</tfoot>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div> <!--box end-->
	<div class="box box-solid">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
							@php
							$__f11 = ['name' => 'total_amount_recovered', 'value' => __('stock_adjustment.total_amount_recovered') . ':'];
							@endphp
							<x-form.label :name="$__f11['name']" :value="$__f11['value']" /> @show_tooltip(__('tooltip.total_amount_recovered'))
							@php
							$__f12 = ['name' => 'total_amount_recovered', 'value' => 0, 'options' => ['class' => 'form-control input_number', 'placeholder' => __('stock_adjustment.total_amount_recovered')]];
							@endphp
							<x-form.input type="text" :name="$__f12['name']" :value="$__f12['value']" :options="$__f12['options']" />
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
							@php
							$__f13 = ['name' => 'additional_notes', 'value' => __('stock_adjustment.reason_for_stock_adjustment') . ':'];
							@endphp
							<x-form.label :name="$__f13['name']" :value="$__f13['value']" />
							@php
							$__f14 = ['name' => 'additional_notes', 'value' => null, 'options' => ['class' => 'form-control', 'placeholder' => __('stock_adjustment.reason_for_stock_adjustment'), 'rows' => 3]];
							@endphp
							<x-form.textarea :name="$__f14['name']" :value="$__f14['value']" :options="$__f14['options']" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
				</div>
			</div>

		</div>
	</div> <!--box end-->
	<x-form.close />
</section>
@stop
@section('javascript')
	<script src="{{ asset('js/stock_adjustment.js?v=' . $asset_v) }}"></script>
@endsection
